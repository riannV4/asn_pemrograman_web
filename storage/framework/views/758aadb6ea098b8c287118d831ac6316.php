<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Financial Report</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333333;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .header {
            margin-bottom: 25px;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 15px;
        }
        .header-title {
            font-size: 24px;
            font-weight: bold;
            color: #1e3a8a;
            margin: 0 0 5px 0;
            text-transform: uppercase;
        }
        .header-subtitle {
            font-size: 12px;
            color: #4b5563;
            margin: 0;
        }
        .report-meta {
            margin-top: 10px;
            font-size: 11px;
            color: #6b7280;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #1e3a8a;
            margin-top: 25px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
            text-transform: uppercase;
        }
        .grid-2 {
            width: 100%;
            margin-bottom: 20px;
        }
        .grid-2 td {
            width: 50%;
            vertical-align: top;
        }
        /* Cards */
        .card {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 10px;
        }
        .card-title {
            font-size: 10px;
            font-weight: bold;
            color: #6b7280;
            text-transform: uppercase;
            margin: 0 0 5px 0;
        }
        .card-value {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .text-green { color: #10b981; }
        .text-red { color: #ef4444; }
        .text-blue { color: #3b82f6; }
        
        /* Tables */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.data-table th {
            background-color: #f3f4f6;
            color: #374151;
            font-weight: bold;
            text-align: left;
            padding: 8px 10px;
            border-bottom: 2px solid #e5e7eb;
            font-size: 11px;
        }
        table.data-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
        .progress-bar-container {
            background-color: #e5e7eb;
            border-radius: 4px;
            height: 8px;
            width: 100px;
            display: inline-block;
            vertical-align: middle;
            margin-right: 8px;
        }
        .progress-bar {
            background-color: #3b82f6;
            height: 8px;
            border-radius: 4px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
        .page-break {
            page-break-after: always;
        }
        .insight-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 10px 15px;
            border-radius: 0 6px 6px 0;
            margin-bottom: 15px;
            font-style: italic;
            color: #1e40af;
        }
    </style>
</head>
<body>

    <div class="header">
        <table style="width: 100%;">
            <tr>
                <td>
                    <h1 class="header-title">Financial Report</h1>
                    <p class="header-subtitle">Kost Expense Tracker - Personal Financial Statement</p>
                </td>
                <td style="text-align: right; vertical-align: bottom;">
                    <div class="report-meta">
                        Generated on: <?php echo e(\Carbon\Carbon::now()->format('d M Y H:i')); ?><br>
                        Period: <strong><?php echo e($startDate->format('d M Y')); ?> - <?php echo e($endDate->format('d M Y')); ?></strong> (<?php echo e(ucfirst($filterType)); ?>)
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Financial Insights Section -->
    <div class="section-title">Financial Summary</div>
    <table class="grid-2">
        <tr>
            <td style="padding-right: 10px;">
                <div class="card">
                    <p class="card-title">Total Income</p>
                    <p class="card-value text-green">Rp <?php echo e(number_format($totalIncome, 0, ',', '.')); ?></p>
                </div>
                <div class="card">
                    <p class="card-title">Total Expense</p>
                    <p class="card-value text-red">Rp <?php echo e(number_format($totalExpense, 0, ',', '.')); ?></p>
                </div>
                <div class="card">
                    <p class="card-title">Net Balance</p>
                    <p class="card-value <?php echo e($balance >= 0 ? 'text-green' : 'text-red'); ?>">
                        Rp <?php echo e(number_format($balance, 0, ',', '.')); ?>

                    </p>
                </div>
            </td>
            <td style="padding-left: 10px;">
                <div class="card">
                    <p class="card-title">Average Daily Expense</p>
                    <p class="card-value text-blue">Rp <?php echo e(number_format($averageDailyExpense, 0, ',', '.')); ?></p>
                </div>
                <div class="card">
                    <p class="card-title">Largest Expense Category</p>
                    <p class="card-value text-blue">
                        <?php echo e($largestCategoryName); ?> 
                        <?php if($largestCategoryAmount > 0): ?>
                            <span style="font-size: 11px; font-weight: normal; color: #4b5563;">
                                (Rp <?php echo e(number_format($largestCategoryAmount, 0, ',', '.')); ?>)
                            </span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="card">
                    <p class="card-title">Savings Percentage</p>
                    <p class="card-value <?php echo e($savingsPercentage >= 0 ? 'text-green' : 'text-red'); ?>">
                        <?php echo e(number_format($savingsPercentage, 1, ',', '.')); ?>%
                    </p>
                </div>
            </td>
        </tr>
    </table>

    <div class="insight-box">
        <strong>Report Insight:</strong> <?php echo e($categoryInsight); ?> <?php echo e($trendInsight); ?>

    </div>

    <!-- Expense Breakdown Table -->
    <div class="section-title">Expense Breakdown by Category</div>
    <?php if(empty($pieChartData['labels'])): ?>
        <p style="color: #6b7280; font-style: italic;">No expense data recorded in this period.</p>
    <?php else: ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th class="text-right">Total Expense</th>
                    <th class="text-center" style="width: 150px;">Percentage</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $pieChartData['labels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $amount = $pieChartData['data'][$index];
                        $percent = $pieChartData['percentages'][$index];
                    ?>
                    <tr>
                        <td style="font-weight: bold;"><?php echo e($label); ?></td>
                        <td class="text-right">Rp <?php echo e(number_format($amount, 0, ',', '.')); ?></td>
                        <td class="text-center">
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: <?php echo e($percent); ?>%;"></div>
                            </div>
                            <span style="font-weight: bold;"><?php echo e(number_format($percent, 1, ',', '.')); ?>%</span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="page-break"></div>

    <!-- Monthly Income vs Expense Comparison (For the active year) -->
    <div class="section-title">Monthly Comparison (Year: <?php echo e(date('Y')); ?>)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Month</th>
                <th class="text-right">Income</th>
                <th class="text-right">Expense</th>
                <th class="text-right">Net Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $barChartData['labels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $inc = $barChartData['income'][$index];
                    $exp = $barChartData['expense'][$index];
                    $net = $inc - $exp;
                ?>
                <tr>
                    <td style="font-weight: bold;"><?php echo e($month); ?></td>
                    <td class="text-right text-green">Rp <?php echo e(number_format($inc, 0, ',', '.')); ?></td>
                    <td class="text-right text-red">Rp <?php echo e(number_format($exp, 0, ',', '.')); ?></td>
                    <td class="text-right <?php echo e($net >= 0 ? 'text-green' : 'text-red'); ?>" style="font-weight: bold;">
                        Rp <?php echo e(number_format($net, 0, ',', '.')); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- Detailed Transactions list for this period -->
    <div class="section-title">Transactions in this Period</div>
    <?php if($transactions->isEmpty()): ?>
        <p style="color: #6b7280; font-style: italic;">No transactions found in this period.</p>
    <?php else: ?>
        <table class="data-table" style="font-size: 10px;">
            <thead>
                <tr>
                    <th style="width: 70px;">Date</th>
                    <th style="width: 100px;">Category</th>
                    <th style="width: 60px;">Type</th>
                    <th>Notes/Description</th>
                    <th class="text-right" style="width: 90px;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($t->transaction_date->format('d M Y')); ?></td>
                        <td><?php echo e($t->category ? $t->category->name : '-'); ?></td>
                        <td class="<?php echo e($t->type === 'income' ? 'text-green' : 'text-red'); ?>" style="font-weight: bold;">
                            <?php echo e($t->type === 'income' ? 'Income' : 'Expense'); ?>

                        </td>
                        <td><?php echo e($t->notes ?? '-'); ?></td>
                        <td class="text-right" style="font-weight: bold;">Rp <?php echo e(number_format($t->amount, 0, ',', '.')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="footer">
        Kost Expense Tracker &copy; <?php echo e(date('Y')); ?> - All Rights Reserved. Generated automatically.
    </div>

</body>
</html>
<?php /**PATH D:\projekpemro\asn_pemrograman_web\resources\views/reports/pdf.blade.php ENDPATH**/ ?>