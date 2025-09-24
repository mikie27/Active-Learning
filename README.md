# Active-Learning

A PHP implementation of active learning algorithms for machine learning applications.

## Overview

Active learning is a special case of machine learning where a learning algorithm can interactively query a user to label new data points with the desired outputs. This repository provides a comprehensive PHP class that implements various active learning strategies.

## Features

- **Multiple Query Strategies**: Uncertainty sampling, random sampling, margin sampling, and entropy sampling
- **Dynamic Data Management**: Add/remove labeled and unlabeled data points
- **Extensible Architecture**: Easy to add custom query strategies
- **Well-documented Code**: Comprehensive PHPDoc comments and examples

## Usage

```php
<?php
require_once 'ActiveLearning.php';

// Initialize with labeled and unlabeled data
$labeledData = [
    ['features' => [1.0, 2.0], 'label' => 'positive'],
    ['features' => [-1.0, -2.0], 'label' => 'negative']
];
$unlabeledData = [[0.0, 0.0], [1.5, 2.5], [-1.5, -2.5]];

$al = new ActiveLearning($labeledData, $unlabeledData);

// Query for the most uncertain data points
$queries = $al->query(2);
foreach ($queries as $query) {
    echo "Data: [" . implode(", ", $query['data']) . "] ";
    echo "Uncertainty: " . $query['uncertainty'] . "\n";
}
```

### Available Query Strategies

- `ActiveLearning::STRATEGY_UNCERTAINTY` - Selects most uncertain samples
- `ActiveLearning::STRATEGY_RANDOM` - Random selection
- `ActiveLearning::STRATEGY_MARGIN` - Smallest margin between predictions
- `ActiveLearning::STRATEGY_ENTROPY` - Highest prediction entropy

## Files

- `ActiveLearning.php` - Main class implementation
- `example.php` - Comprehensive usage examples and demo

## Running the Example

```bash
php example.php
```

This will demonstrate all the features of the ActiveLearning class including different query strategies and a simulated active learning loop.