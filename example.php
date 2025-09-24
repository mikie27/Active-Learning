<?php

require_once 'ActiveLearning.php';

/**
 * Example usage of the ActiveLearning class
 * 
 * This script demonstrates how to use the ActiveLearning class
 * for various active learning scenarios.
 */

echo "=== Active Learning PHP Class Demo ===\n\n";

// Create sample data
$labeledData = [
    ['features' => [1.0, 2.0, 3.0], 'label' => 'positive'],
    ['features' => [2.0, 3.0, 4.0], 'label' => 'positive'],
    ['features' => [-1.0, -2.0, -1.0], 'label' => 'negative'],
    ['features' => [-2.0, -1.0, -2.0], 'label' => 'negative'],
];

$unlabeledData = [
    [1.5, 2.5, 3.5],
    [0.0, 0.0, 0.0],
    [3.0, 4.0, 5.0],
    [-3.0, -2.0, -1.0],
    [0.5, 1.0, 1.5],
    [-0.5, -1.0, -0.5],
];

// Initialize Active Learning with uncertainty sampling
echo "1. Creating ActiveLearning instance with uncertainty sampling...\n";
$al = new ActiveLearning($labeledData, $unlabeledData, ActiveLearning::STRATEGY_UNCERTAINTY);

echo "   - Labeled data points: " . $al->getLabeledDataCount() . "\n";
echo "   - Unlabeled data points: " . $al->getUnlabeledDataCount() . "\n";
echo "   - Current strategy: " . $al->getStrategy() . "\n\n";

// Test uncertainty sampling
echo "2. Testing Uncertainty Sampling Strategy:\n";
$queries = $al->query(3);
foreach ($queries as $i => $query) {
    echo "   Query " . ($i + 1) . ": ";
    echo "Data: [" . implode(", ", $query['data']) . "] ";
    echo "Uncertainty: " . round($query['uncertainty'], 3) . "\n";
}
echo "\n";

// Test different strategies
$strategies = [
    ActiveLearning::STRATEGY_RANDOM => 'Random Sampling',
    ActiveLearning::STRATEGY_MARGIN => 'Margin Sampling',
    ActiveLearning::STRATEGY_ENTROPY => 'Entropy Sampling'
];

foreach ($strategies as $strategy => $name) {
    echo "3. Testing $name Strategy:\n";
    $al->setStrategy($strategy);
    $queries = $al->query(2);
    
    foreach ($queries as $i => $query) {
        echo "   Query " . ($i + 1) . ": ";
        echo "Data: [" . implode(", ", $query['data']) . "] ";
        echo "Score: " . round($query['uncertainty'], 3) . "\n";
    }
    echo "\n";
}

// Demonstrate adding new data
echo "4. Adding new labeled data and querying again:\n";
$al->setStrategy(ActiveLearning::STRATEGY_UNCERTAINTY);
$al->addLabeledData([0.0, 0.0, 0.0], 'neutral');

echo "   - New labeled data count: " . $al->getLabeledDataCount() . "\n";
$queries = $al->query(2);
foreach ($queries as $i => $query) {
    echo "   Query " . ($i + 1) . ": ";
    echo "Data: [" . implode(", ", $query['data']) . "] ";
    echo "Uncertainty: " . round($query['uncertainty'], 3) . "\n";
}
echo "\n";

// Simulate active learning loop
echo "5. Simulating Active Learning Loop:\n";
echo "   Starting with " . $al->getLabeledDataCount() . " labeled and " . $al->getUnlabeledDataCount() . " unlabeled samples\n";

for ($iteration = 1; $iteration <= 3; $iteration++) {
    echo "   \n   Iteration $iteration:\n";
    
    // Query for the most uncertain sample
    $queries = $al->query(1);
    if (empty($queries)) {
        echo "   No more unlabeled data to query.\n";
        break;
    }
    
    $query = $queries[0];
    echo "   - Selected data: [" . implode(", ", $query['data']) . "] (uncertainty: " . round($query['uncertainty'], 3) . ")\n";
    
    // Simulate labeling (simple rule: positive if sum > 2, negative otherwise)
    $sum = array_sum($query['data']);
    $label = $sum > 2 ? 'positive' : 'negative';
    echo "   - Assigned label: $label\n";
    
    // Add to labeled data and remove from unlabeled
    $al->addLabeledData($query['data'], $label);
    $al->removeUnlabeledData($query['index']);
    
    echo "   - Updated counts - Labeled: " . $al->getLabeledDataCount() . ", Unlabeled: " . $al->getUnlabeledDataCount() . "\n";
}

echo "\n=== Demo Complete ===\n";
echo "The ActiveLearning class successfully demonstrates:\n";
echo "- Multiple query strategies (uncertainty, random, margin, entropy)\n";
echo "- Dynamic data management (adding/removing samples)\n";
echo "- Iterative active learning workflow\n";
echo "- Extensible architecture for custom strategies\n";