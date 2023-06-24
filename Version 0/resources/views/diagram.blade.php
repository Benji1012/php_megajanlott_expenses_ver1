<!--<!DOCTYPE html>
<html>
<head>
    <title>Expense Diagram</title>
    <!-- Include Chart.js library 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <form action="/" method="GET">
            @csrf
            <button type="submit">Back to home</button>
        </form>
    </div>
    <canvas id="expenseChart"></canvas>

    <script>
        // Get the expenses data from the server
        const expenses = @json($expenses);
        
        // Create an object to store the aggregated amounts by store
        const aggregatedAmounts = {};
        
        // Aggregate the amounts by store
        expenses.forEach(expense => {
            const store = expense.store;
            const amount = expense.amount;
            if (aggregatedAmounts.hasOwnProperty(store)) {
                aggregatedAmounts[store] += amount;
            } else {
                aggregatedAmounts[store] = amount;
            }
        });
        
        // Extract the store labels and aggregated amounts
        const storeLabels = Object.keys(aggregatedAmounts);
        const aggregatedAmountData = Object.values(aggregatedAmounts);

        // Create the chart
        const ctx = document.getElementById('expenseChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: storeLabels,
                datasets: [{
                    label: 'Expense Amount',
                    data: aggregatedAmountData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
-->
<!DOCTYPE html>
<html>
<head>
    <title>Expense Diagram</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!--<div>
        <form action="/" method="GET">
            @csrf
            <button type="submit">Back to home</button>
        </form>
    </div>-->
    <canvas id="expenseByStoreChart"></canvas>
    <canvas id="expenseByTypeChart"></canvas>

    <script>
        // Get the expenses data from the server
        const expenses = @json($expenses);
        
        // Create an object to store the aggregated amounts by store
        const aggregatedAmountsByStore = {};
        
        // Create an object to store the aggregated amounts by type of expense
        const aggregatedAmountsByType = {};

        // Aggregate the amounts by store and type of expense
        expenses.forEach(expense => {
            const store = expense.store;
            const type = expense.type;
            const amount = expense.amount;
            
            // Aggregate by store
            if (aggregatedAmountsByStore.hasOwnProperty(store)) {
                aggregatedAmountsByStore[store] += amount;
            } else {
                aggregatedAmountsByStore[store] = amount;
            }
            
            // Aggregate by type of expense
            if (aggregatedAmountsByType.hasOwnProperty(type)) {
                aggregatedAmountsByType[type] += amount;
            } else {
                aggregatedAmountsByType[type] = amount;
            }
        });
        
        // Extract the store labels and aggregated amounts
        const storeLabels = Object.keys(aggregatedAmountsByStore);
        const aggregatedAmountDataByStore = Object.values(aggregatedAmountsByStore);
        
        // Extract the type labels and aggregated amounts
        const typeLabels = Object.keys(aggregatedAmountsByType);
        const aggregatedAmountDataByType = Object.values(aggregatedAmountsByType);

        // Create the chart for expenses by store
        const ctxStore = document.getElementById('expenseByStoreChart').getContext('2d');
        new Chart(ctxStore, {
            type: 'bar',
            data: {
                labels: storeLabels,
                datasets: [{
                    label: 'Expense Amount by Store',
                    data: aggregatedAmountDataByStore,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Create the chart for expenses by type
        const ctxType = document.getElementById('expenseByTypeChart').getContext('2d');
        new Chart(ctxType, {
            type: 'bar',
            data: {
                labels: typeLabels,
                datasets: [{
                    label: 'Expense Amount by Type',
                    data: aggregatedAmountDataByType,
                    backgroundColor: 'rgba(192, 75, 192, 0.2)',
                    borderColor: 'rgba(192, 75, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
