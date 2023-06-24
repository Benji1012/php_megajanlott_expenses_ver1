<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div style="border: 3px solid black;">
        <h2>Filtered expenses</h2>
        <table>
            <thead>
                <tr>
                    <th>Store Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Type of Payment</th>
                    <th>Expense type</th>
                    <th>Comment</th>
                </tr>
            </thead>
        
            
            <tbody>
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{$expense->store}}</td>
                        <td>{{$expense->amount}}</td>
                        <td>{{$expense->when}}</td>
                        <td>{{$expense->paymentType}}</td>
                        <td>{{$expense->type}}</td>
                        <td>{{$expense->comment}}</td>
                    </tr>
                    @endforeach
            </tbody>

        </table>
    </div>
  </body>
</html>