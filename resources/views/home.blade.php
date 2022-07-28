<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hotels Search Page</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style>
        .float::-webkit-outer-spin-button,
        .float::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .float[type=number] {
            -moz-appearance: textfield;
        }

        .digit {
            width: 50px;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
        }

        .table, .form, .error {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-top: 50px;
        }

        .inputbox {
            display: flex;
            flex-flow: column;
        }

        label {
            display: block;
        }

        .form {
            width: 100%;
            align-items: center;
            justify-content: center;
        }

    </style>
</head>

<body>
    <div class="form">
        <form id="searchForm">
            <div class="inputbox">
                <label for="name">Name: </label>
                <input id="name" type="text" name="name">
            </div>

            <div class="inputbox">
                <label for="bedrooms">Bedrooms: </label>
                <input class="digit" id="bedrooms" type="number" name="bedrooms">
            </div>

            <div class="inputbox">
                <label for="bathrooms">Bathrooms: </label>
                <input class="digit" id="bathrooms" type="number" name="bathrooms">
            </div>

            <div class="inputbox">
                <label for="storeys">Storeys: </label>
                <input class="digit" id="storeys" type="number" name="storeys">
            </div>

            <div class="inputbox">
                <label for="garages">Garages: </label>
                <input class="digit" id="garages" type="number" name="garages">
            </div>

            <div class="inputbox">
                <label for="price_from">Price from: </label>
                <input class="float" id="price_from" type="number" name="price_from">
            </div>

            <div class="inputbox">
                <label for="price_to">Price to: </label>
                <input class="float" id="price_to" type="number" name="price_to">
            </div>

            <button onclick="handleSearch(event)">Search</button>
        </form>
    </div>

    <div class="table">

        <table>

            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Bedrooms</th>
            <th>Bathrooms</th>
            <th>Storeys</th>
            <th>Garages</th>
            </thead>

            <tbody id="hotels">

            </tbody>

        </table>
    </div>

    <div class="error">

    </div>

    <script>
        $('.table').hide();
        $('.error').hide();

        function handleSearch(e) {
            e.preventDefault();

            let searchApiUrl = "{{ env('API_URL') . 'search?' }}";
            let queryString = $('#searchForm').serialize();
            let url = searchApiUrl + queryString;
            let tableRows = '';

            let xmlHttpRequest = new XMLHttpRequest();

            xmlHttpRequest.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    $('.error').fadeOut();

                    let results = JSON.parse(this.responseText).content;

                    tableRows += results.map((item) => (
                        `<tr>
                            <td>${item.id}</td>
                            <td>${item.name}</td>
                            <td>${item.price}</td>
                            <td>${item.bedrooms}</td>
                            <td>${item.bathrooms}</td>
                            <td>${item.storeys}</td>
                            <td>${item.garages}</td>
                        </tr>`
                    ));

                    $('#hotels').html(tableRows);

                    $('.table').fadeIn();
                } else if (this.readyState === 4 && this.status === 404) {
                    $('.table').fadeOut();
                    $('.error').html(JSON.parse(this.responseText).error).fadeIn();
                } else if (this.readyState === 4) {
                    $('.table').fadeOut();
                    $('.error').html('CANT LOAD DATA').fadeIn();
                }
            }

            xmlHttpRequest.open("GET", url, true);
            xmlHttpRequest.send();
        }
    </script>
</body>

</html>
