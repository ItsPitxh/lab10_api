<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Car Dealership CRUD</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>🚗 Car Dealership Inventory</h1>

<!-- Add New Car Form -->
<form id="addCarForm">
    <input type="text" name="Brand" placeholder="Brand" required>
    <input type="text" name="Model" placeholder="Model" required>
    <input type="number" name="Year" placeholder="Year" required>
    <input type="number" name="Price" placeholder="Price" required>
    <input type="number" name="Mileage" placeholder="Mileage" required>
    <select name="Status">
        <option value="New">New</option>
        <option value="Used">Used</option>
    </select>
    <button type="submit">Add Car</button>
</form>

<table id="carsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Year</th>
            <th>Price</th>
            <th>Mileage</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
// API URL
const apiUrl = 'http://localhost/appliances_api/src/cars';

// Fetch and display cars
function loadCars() {
    fetch(apiUrl)
    .then(res => res.json())
    .then(cars => {
        const tbody = document.querySelector("#carsTable tbody");
        tbody.innerHTML = '';
        cars.forEach(car => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${car.CarID}</td>
                <td contenteditable="true" data-field="Brand">${car.Brand}</td>
                <td contenteditable="true" data-field="Model">${car.Model}</td>
                <td contenteditable="true" data-field="Year">${car.Year}</td>
                <td contenteditable="true" data-field="Price">${car.Price}</td>
                <td contenteditable="true" data-field="Mileage">${car.Mileage}</td>
                <td contenteditable="true" data-field="Status">${car.Status}</td>
                <td>
                    <button onclick="updateCar(${car.CarID}, this)">Update</button>
                    <button onclick="deleteCar(${car.CarID})">Delete</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    });
}

// Add Car
document.getElementById('addCarForm').addEventListener('submit', function(e){
    e.preventDefault();
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    fetch(apiUrl, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    }).then(res => res.json())
      .then(res => { alert(res.message); loadCars(); this.reset(); });
});

// Update Car
function updateCar(id, btn) {
    const tr = btn.closest('tr');
    const data = {};
    tr.querySelectorAll('[contenteditable]').forEach(td => {
        data[td.dataset.field] = td.innerText;
    });
    fetch(`${apiUrl}?id=${id}`, {
        method: 'PUT',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    }).then(res => res.json())
      .then(res => { alert(res.message); loadCars(); });
}

// Delete Car
function deleteCar(id) {
    if(confirm('Are you sure?')) {
        fetch(`${apiUrl}?id=${id}`, {method: 'DELETE'})
        .then(res => res.json())
        .then(res => { alert(res.message); loadCars(); });
    }
}

// Initial load
loadCars();
</script>
</body>
</html>