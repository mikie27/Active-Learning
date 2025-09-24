<?php

/**
 * Active Learning Class
 * 
 * This class implements various active learning strategies for machine learning
 * applications. Active learning is a special case of machine learning where
 * a learning algorithm can interactively query a user to label new data points
 * with the desired outputs.
 * 
 * @author Active Learning Repository
 * @version 1.0
 */
class ActiveLearning
{
    /**
     * @var array $labeledData Array of labeled training data
     * @var array $unlabeledData Array of unlabeled data points
     * @var string $strategy Current query strategy being used
     */
    private $labeledData;
    private $unlabeledData;
    private $strategy;
    
    /**
     * Available query strategies
     */
    const STRATEGY_UNCERTAINTY = 'uncertainty';
    const STRATEGY_RANDOM = 'random';
    const STRATEGY_MARGIN = 'margin';
    const STRATEGY_ENTROPY = 'entropy';
    
    /**
     * Constructor
     * 
     * @param array $labeledData Initial labeled dataset
     * @param array $unlabeledData Pool of unlabeled data
     * @param string $strategy Query strategy to use
     */
    public function __construct($labeledData = [], $unlabeledData = [], $strategy = self::STRATEGY_UNCERTAINTY)
    {
        $this->labeledData = $labeledData;
        $this->unlabeledData = $unlabeledData;
        $this->strategy = $strategy;
    }
    
    /**
     * Add labeled data to the training set
     * 
     * @param array $data Data point with features
     * @param mixed $label Label for the data point
     * @return void
     */
    public function addLabeledData($data, $label)
    {
        $this->labeledData[] = [
            'features' => $data,
            'label' => $label
        ];
    }
    
    /**
     * Add unlabeled data to the pool
     * 
     * @param array $data Array of unlabeled data points
     * @return void
     */
    public function addUnlabeledData($data)
    {
        $this->unlabeledData = array_merge($this->unlabeledData, $data);
    }
    
    /**
     * Query for the next best data point to label based on the current strategy
     * 
     * @param int $count Number of data points to query (default: 1)
     * @return array Array of data points to label
     */
    public function query($count = 1)
    {
        if (empty($this->unlabeledData)) {
            return [];
        }
        
        switch ($this->strategy) {
            case self::STRATEGY_UNCERTAINTY:
                return $this->uncertaintySampling($count);
            case self::STRATEGY_RANDOM:
                return $this->randomSampling($count);
            case self::STRATEGY_MARGIN:
                return $this->marginSampling($count);
            case self::STRATEGY_ENTROPY:
                return $this->entropySampling($count);
            default:
                return $this->randomSampling($count);
        }
    }
    
    /**
     * Uncertainty sampling strategy
     * Selects data points where the model is most uncertain
     * 
     * @param int $count Number of samples to return
     * @return array Selected data points
     */
    private function uncertaintySampling($count)
    {
        $uncertainties = [];
        
        foreach ($this->unlabeledData as $index => $dataPoint) {
            $uncertainty = $this->calculateUncertainty($dataPoint);
            $uncertainties[] = [
                'index' => $index,
                'data' => $dataPoint,
                'uncertainty' => $uncertainty
            ];
        }
        
        // Sort by uncertainty (descending)
        usort($uncertainties, function($a, $b) {
            return $b['uncertainty'] <=> $a['uncertainty'];
        });
        
        return array_slice($uncertainties, 0, $count);
    }
    
    /**
     * Random sampling strategy
     * Randomly selects data points from the unlabeled pool
     * 
     * @param int $count Number of samples to return
     * @return array Selected data points
     */
    private function randomSampling($count)
    {
        $indices = array_rand($this->unlabeledData, min($count, count($this->unlabeledData)));
        
        if (!is_array($indices)) {
            $indices = [$indices];
        }
        
        $result = [];
        foreach ($indices as $index) {
            $result[] = [
                'index' => $index,
                'data' => $this->unlabeledData[$index],
                'uncertainty' => 0.5 // Random selection has neutral uncertainty
            ];
        }
        
        return $result;
    }
    
    /**
     * Margin sampling strategy
     * Selects data points with smallest margin between top predictions
     * 
     * @param int $count Number of samples to return
     * @return array Selected data points
     */
    private function marginSampling($count)
    {
        $margins = [];
        
        foreach ($this->unlabeledData as $index => $dataPoint) {
            $margin = $this->calculateMargin($dataPoint);
            $margins[] = [
                'index' => $index,
                'data' => $dataPoint,
                'uncertainty' => 1 - $margin // Convert margin to uncertainty
            ];
        }
        
        // Sort by margin (ascending - smallest margin first)
        usort($margins, function($a, $b) {
            return $b['uncertainty'] <=> $a['uncertainty'];
        });
        
        return array_slice($margins, 0, $count);
    }
    
    /**
     * Entropy sampling strategy
     * Selects data points with highest prediction entropy
     * 
     * @param int $count Number of samples to return
     * @return array Selected data points
     */
    private function entropySampling($count)
    {
        $entropies = [];
        
        foreach ($this->unlabeledData as $index => $dataPoint) {
            $entropy = $this->calculateEntropy($dataPoint);
            $entropies[] = [
                'index' => $index,
                'data' => $dataPoint,
                'uncertainty' => $entropy
            ];
        }
        
        // Sort by entropy (descending)
        usort($entropies, function($a, $b) {
            return $b['uncertainty'] <=> $a['uncertainty'];
        });
        
        return array_slice($entropies, 0, $count);
    }
    
    /**
     * Calculate uncertainty for a data point
     * This is a simplified implementation - in practice, this would use
     * the actual model's prediction confidence
     * 
     * @param array $dataPoint Data point to calculate uncertainty for
     * @return float Uncertainty score (0-1)
     */
    private function calculateUncertainty($dataPoint)
    {
        // Simplified uncertainty calculation based on distance to labeled data
        if (empty($this->labeledData)) {
            return 0.5; // Neutral uncertainty if no labeled data
        }
        
        $minDistance = PHP_FLOAT_MAX;
        foreach ($this->labeledData as $labeled) {
            $distance = $this->euclideanDistance($dataPoint, $labeled['features']);
            $minDistance = min($minDistance, $distance);
        }
        
        // Convert distance to uncertainty (normalize to 0-1 range)
        return min(1.0, $minDistance / 10.0);
    }
    
    /**
     * Calculate margin between top two class predictions
     * 
     * @param array $dataPoint Data point to calculate margin for
     * @return float Margin score (0-1)
     */
    private function calculateMargin($dataPoint)
    {
        // Simplified margin calculation
        $uncertainty = $this->calculateUncertainty($dataPoint);
        return 1 - abs($uncertainty - 0.5) * 2; // Convert uncertainty to margin
    }
    
    /**
     * Calculate entropy of class predictions
     * 
     * @param array $dataPoint Data point to calculate entropy for
     * @return float Entropy score
     */
    private function calculateEntropy($dataPoint)
    {
        // Simplified entropy calculation
        $uncertainty = $this->calculateUncertainty($dataPoint);
        
        // Binary entropy calculation
        if ($uncertainty == 0 || $uncertainty == 1) {
            return 0;
        }
        
        return -($uncertainty * log($uncertainty, 2) + (1 - $uncertainty) * log(1 - $uncertainty, 2));
    }
    
    /**
     * Calculate Euclidean distance between two data points
     * 
     * @param array $point1 First data point
     * @param array $point2 Second data point
     * @return float Euclidean distance
     */
    private function euclideanDistance($point1, $point2)
    {
        if (!is_array($point1) || !is_array($point2)) {
            return 0;
        }
        
        $sum = 0;
        $maxLength = max(count($point1), count($point2));
        
        for ($i = 0; $i < $maxLength; $i++) {
            $val1 = isset($point1[$i]) ? $point1[$i] : 0;
            $val2 = isset($point2[$i]) ? $point2[$i] : 0;
            $sum += pow($val1 - $val2, 2);
        }
        
        return sqrt($sum);
    }
    
    /**
     * Get current strategy
     * 
     * @return string Current query strategy
     */
    public function getStrategy()
    {
        return $this->strategy;
    }
    
    /**
     * Set query strategy
     * 
     * @param string $strategy New strategy to use
     * @return void
     */
    public function setStrategy($strategy)
    {
        $availableStrategies = [
            self::STRATEGY_UNCERTAINTY,
            self::STRATEGY_RANDOM,
            self::STRATEGY_MARGIN,
            self::STRATEGY_ENTROPY
        ];
        
        if (in_array($strategy, $availableStrategies)) {
            $this->strategy = $strategy;
        } else {
            throw new InvalidArgumentException("Invalid strategy: $strategy");
        }
    }
    
    /**
     * Get labeled data count
     * 
     * @return int Number of labeled data points
     */
    public function getLabeledDataCount()
    {
        return count($this->labeledData);
    }
    
    /**
     * Get unlabeled data count
     * 
     * @return int Number of unlabeled data points
     */
    public function getUnlabeledDataCount()
    {
        return count($this->unlabeledData);
    }
    
    /**
     * Get all labeled data
     * 
     * @return array All labeled data points
     */
    public function getLabeledData()
    {
        return $this->labeledData;
    }
    
    /**
     * Remove data point from unlabeled pool (typically after labeling)
     * 
     * @param int $index Index of data point to remove
     * @return void
     */
    public function removeUnlabeledData($index)
    {
        if (isset($this->unlabeledData[$index])) {
            unset($this->unlabeledData[$index]);
            $this->unlabeledData = array_values($this->unlabeledData); // Re-index array
        }
    }
}