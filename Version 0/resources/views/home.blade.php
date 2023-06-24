<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
   <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css%22%3E">
   --> <link rel="stylesheet" href="{{ asset ('home.css') }}">
   
   
</head>
<body>

    @auth
        </div>
            <p>Welcome back {{auth()->user()->name}}</p>
            <form action="/logout" method="POST">
                @csrf
                <button>Log out</button>
            </form>
            <div style="border: 3px solid black;">
                <h2>Create a new Expense</h2>
                <form action="/create-expense" method="POST">
                    @csrf
                    <input type="text" name="store" placeholder="Store name">
                    <input type="number" name="amount" placeholder="Amount in Ft">
                    <input type="date" name="when">
                
                    <label for="paymentType">Coose a type of payment</label>
                    <select id="paymentType" name="paymentType">
                        <option value="Cash">Cash</option>
                        <option value="Voucher">Voucher</option>
                        <option value="CreditCard">Credit Card</option>
                    </select>
                </select>
                <label for="paymentType">Coose a type of Expense</label>
                <select id="type" name="type" >
                    <option value="Shopping">Shopping</option>
                    <option value="Bill">Bill</option>
                    <option value="Restaurant">Restaurant</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Other">Other</option>
                </select>
                    <textarea name="comment" placeholder="Comment"></textarea>
                    <button>Save expense</button>
                </form>
            </div>
            <div>
                <h2>Filters</h2>
                <form action="/filter-expense" method="GET">
                    @csrf
                    <input type="text" name="storeFilter" value="" placeholder="Store name">
                    <input type="number" name="amountBiggerFilter" value="" placeholder="Bigger amount than...">
                    <input type="number" name="amountSmallerFilter" value="" placeholder="Smaller amount than...">
                    <label for="whenFromFilter">After:</label>
                    <input type="date" name="whenFromFilter">
                    <label for="whenToFilter">Before:</label>
                    <input type="date" name="whenToFilter">
                    <label for="paymentTypeFilter">Type of payment</label>
                    <select id="paymentType" name="paymentTypeFilter">
                        <option value="All">All</option>
                        <option value="Cash">Cash</option>
                        <option value="Voucher">Voucher</option>
                        <option value="CreditCard">Credit Card</option>
                    </select>
                    </select>
                    <label for="typeFilter">Type of Expense</label>
                    <select id="type" name="typeFilter" >
                        <option value="All">All</option>
                        <option value="Shopping">Shopping</option>
                        <option value="Bill">Bill</option>
                        <option value="Restaurant">Restaurant</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Other">Other</option>
                    </select>
                    <button type="submit">Filter</button>
                    <form action="/" method="GET">
                        @csrf
                        <button type="submit">Clear Filters</button>
                    </form>
                    <form action="/filter-expense-diagram" method="GET" target="_blank">
                        @csrf
                        <input type="hidden" name="storeFilter" value="{{ request('storeFilter') }}">
                        <input type="hidden" name="amountBiggerFilter" value="{{ request('amountBiggerFilter') }}">
                        <input type="hidden" name="amountSmallerFilter" value="{{ request('amountSmallerFilter') }}">
                        <input type="hidden" name="whenFromFilter" value="{{ request('whenFromFilter') }}">
                        <input type="hidden" name="whenToFilter" value="{{ request('whenToFilter') }}">
                        <input type="hidden" name="paymentTypeFilter" value="{{ request('paymentTypeFilter') }}">
                        <input type="hidden" name="typeFilter" value="{{ request('typeFilter') }}">
                        <button type="submit">Generate Diagram</button>
                    </form>
                    <form action="/create-pdf" method="GET" target="_blank">
                        @csrf
                        <input type="hidden" name="storeFilter" value="{{ request('storeFilter') }}">
                        <input type="hidden" name="amountBiggerFilter" value="{{ request('amountBiggerFilter') }}">
                        <input type="hidden" name="amountSmallerFilter" value="{{ request('amountSmallerFilter') }}">
                        <input type="hidden" name="whenFromFilter" value="{{ request('whenFromFilter') }}">
                        <input type="hidden" name="whenToFilter" value="{{ request('whenToFilter') }}">
                        <input type="hidden" name="paymentTypeFilter" value="{{ request('paymentTypeFilter') }}">
                        <input type="hidden" name="typeFilter" value="{{ request('typeFilter') }}">
                        <button type="submit">Create PDF</button>
                    </form>
                </form>
            

            </div>
            <div style="border: 3px solid black;">
                <h2>All expenses</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Store Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Type of Payment</th>
                            <th>Expense type</th>
                            <th>Comment</th>
                            <th>Actions</th>
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
                            <td>
                                <a href="/edit-expense/{{$expense->id}}">Edit</a>
                                <form action="delete-expense/{{$expense->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        @else
            <div class="section">
                <div class="container">
                    <div class="row full-height justify-content-center">
                        <div class="col-12 text-center align-self-center py-5">
                            <div class="section pb-5 pt-5 pt-sm-2 text-center">
                                
                                <h6><span>  </span></h6>
                                <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                                <label for="reg-log"></label>
                                <div class="card-3d-wrap mx-auto">
                                    <div class="card-3d-wrapper">
                                        <div class="card-front">
                                            <div class="center-wrap">
                                                <div class="section text-center">
                                                    <h4 class="mb-4 pb-3">Log In</h4>
                                                    <form action="/login" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="email" name="loginemail" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
                                                            
                                                        </div>	
                                                        <div class="form-group mt-2">
                                                            <input type="password" name="loginpassword" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                                                            
                                                        </div>
                                                        <button type="submit" class="btn mt-4">Login</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-back">
                                            <div class="center-wrap">
                                                <div class="section text-center">
                                                    <h4 class="mb-4 pb-3">Sign Up</h4>
                                                    <form action="/register" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                        <input type="text" name="name" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                        <input type="email" name="email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                        <input type="password" name="password" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                                                        </div>
                                                        <button type="submit" class="btn mt-4" >Register</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endauth
        </div>
    
       
</body>
</html>