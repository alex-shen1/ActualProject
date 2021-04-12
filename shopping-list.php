<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="Meal Planning Web Application"/>
    <meta name="author" content="Jennifer Long, Alex Shen"/>
    <title>Fridgin'Cool - Shopping List</title>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
          type="text/css"/>
    <!-- Stylesheets (includes Bootstrap)-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet"/>

    <style>
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Fridgin'Cool</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
            <a class="nav-link" href="meals.php">Meals</a>
            <a class="nav-link  active" href="shopping-list.php">Shopping List</a>
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Planner (TBD)</a>
        </div>
    </div>
</nav>

<div id="content" class="container py-5">
    <h2 id="pageHeader">My Shopping List</h2>
    <div class="row py-4">
        <div class="col bg-white m-3 py-4">
            <table class="table" id="table">
                <thead>
                <th scope="col">Item</th>
                <th scope="col">Quantity</th>
                <th scope="col">Estimated Price/Unit ($)</th>
                <th scope="col">Estimated Price ($)</th>
                </thead>
                <tbody>
                <tr id="inputs">
                    <td><input id="item" placeholder="Item"></td>
                    <td><input id="quantity" placeholder="Quantity" onchange="updateItemPrice(this.id)"></td>
                    <td><input id="estimated-ppu" placeholder="Estimated Cost/Unit" onchange="updateItemPrice(this.id)"></td>
                    <td><input id="total-item-cost" disabled="true"></td>
                </tr>
                <tr id="total">
                    <!--empty cells  for proper spacing-->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="display: flex"><b>Total Price</b>:&nbsp;<div id="total-cost"></div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div style="display:flex">
                <a class="display-4 text-radish" onclick="addRow()"><i class="fas fa-plus-circle"></i></a>
            </div>
<!--            <div id="invalid-input-alert">-->
                <h5 class="text-radish" id="invalid-input-alert"></h5>
<!--            </div>-->
        </div>
    </div>
</div>

<footer class="primary-footer bg-dark text-white">
    <small class="copyright">&copy; 2021 Jennifer Long (rz5sc), Alex Shen (as5gd)</small>
</footer>

</body>

<script>
    function addRow() {
        // Convert the HTMLCollection to an array we can call map() on
        const input_cells = Array.prototype.slice.call(document.getElementById('inputs').cells)
        // Required anonymous function!
        const inputs = input_cells.map(x => x.children[0].value)


        // Test whether or not inputs are valid (0 if valid). This absolutely does not need
        // to be an anonymous function, but it is because we're required to have at least one. :P
        let inputValidity = (function () {
            let return_code = 0
            const name = inputs[0]
            const quantity = inputs[1] != "" ? Number(inputs[1]) : NaN
            const pricePerUnit = inputs[2] !== "" ? parseFloat(inputs[2]) : NaN

            if(name === ""){
                return_code += 1
            }
            // We need quantity to be an integer, and we only care that pricePerUnit is not NaN.
            if(!Number.isInteger(quantity)){
                return_code += 10
            }
            if(isNaN(pricePerUnit)){
                return_code += 100
            }
            console.log(return_code)
            return return_code
        }())
        if (inputValidity == 0) {
            let table = document.getElementById('table')

            // Create new row and fill it with cells
            let row = table.insertRow(table.rows.length - 2)
            let itemCell = row.insertCell(0)
            let quantityCell = row.insertCell(1)
            let pricePerUnitCell = row.insertCell(2)
            let totalPriceCell = row.insertCell(3)

            // Set values of newly created row using inputs
            // Inputs are all the first child of their cell
            itemCell.innerText = inputs[0]
            quantityCell.innerText = inputs[1]
            pricePerUnitCell.innerText = inputs[2]
            totalPriceCell.innerText = inputs[3]

            // Set IDs so we can refer to them later
            // There are 3 "rows" that exist before any items are added; this is to allow first item to have ID=1
            let itemID = table.rows.length - 3
            row.id = `item-${itemID}`
            itemCell.id = `item-name-${itemID}`
            quantityCell.id = `quantity-${itemID}`
            pricePerUnitCell.id = `ppu-${itemID}`
            totalPriceCell.id = `total-price-${itemID}`

            // Reset input boxes for next item
            let input_cells = document.getElementById('inputs').cells
            input_cells[0].children[0].value = ""
            input_cells[1].children[0].value = ""
            input_cells[2].children[0].value = ""
            input_cells[3].children[0].value = ""

            // Set cell indicating total cost of all items
            let totalCost = 0
            for (let i = 1; i <= table.rows.length - 3; i++) { // need to -3 instead of -2 because we just inserted an empty row
                totalCost += parseFloat(table.rows[i].cells[3].innerText)
            }
            document.getElementById('total-cost').innerText = `$${totalCost}`

            // Clear invalid input alert (if it was there before)
            document.getElementById('invalid-input-alert').innerHTML = ''
            document.getElementById('invalid-input-alert').style.visibility = "hidden";
        } else {
            // Fills error message based on validity code (basically bitwise logic)
            let errorMessage = '<b>Error adding item:</b>'
            if(inputValidity % 10 === 1){
                errorMessage += '<br>Item name must not be empty'
            }
            inputValidity = Math.floor(inputValidity/10)
            if(inputValidity % 10 === 1){
                errorMessage += '<br>Item quantity must be an integer'
            }
            inputValidity = Math.floor(inputValidity/10)
            if(inputValidity % 10 === 1){
                errorMessage += '<br>Estimated price/unit must be a number'
            }
            document.getElementById('invalid-input-alert').innerHTML = errorMessage
            document.getElementById('invalid-input-alert').style.visibility = "visible";
        }
    }

    function updateItemPrice(id) {
        // Don't use the ID now, but will use later when we add row-by-row edit feature
        let price_element = document.getElementById('total-item-cost')
        const quantity = parseInt(document.getElementById('quantity').value)
        const ppu = parseFloat(document.getElementById('estimated-ppu').value)
        price_element.value = quantity * ppu
    }
</script>
</html>
