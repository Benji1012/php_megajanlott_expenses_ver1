<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="border: 3px solid black;">
        <h2>Edit Expense</h2>
        <form action="/edit-expense/{{$expense->id}}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="store" value="{{$expense->store}}">
            <input type="number" name="amount" value="{{$expense->amount}}">
            <input type="date" name="when" value="{{$expense->when}}">
        
            <label for="paymentType">Coose a type of payment</label>
            <select id="paymentType" name="paymentType" value="{{$expense->paymentType}}">
                <option value="cash" {{$expense->paymentType === 'cash' ? 'selected' : ''}}>Cash</option>
                <option value="voucher" {{$expense->paymentType === 'voucher' ? 'selected' : ''}}>Voucher</option>
                <option value="creditCard" {{$expense->paymentType === 'creditCard' ? 'selected' : ''}}>Credit Card</option>
            </select>
            
        </select>
        <label for="paymentType">Coose a type of Expense</label>
        <select id="type" name="type" value="{{$expense->type}}">
            <option value="Shopping" {{$expense->type === 'Shopping' ? 'selected' :''}}>Shopping</option>
            <option value="Bill" {{$expense->type === 'Bill' ? 'selected' :''}} >Bill</option>
            <option value="Restaurant" {{$expense->type === 'Restaurant' ? 'selected' :''}} >Restaurant</option>
            <option value="Entertainment" {{$expense->type === 'Entertainment' ? 'selected' :''}} >Entertainment</option>
            <option value="Other" {{$expense->type === 'Other' ? 'selected' :''}} >Other</option>
        </select>
            <textarea name="comment">{{$expense->comment}}</textarea>
            <button>Save changes</button>
        </form>
    </div>
</body>
</html>