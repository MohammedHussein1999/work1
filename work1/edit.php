<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Local Storage Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Local Storage Data</h2>
    <table id="dataTable">
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Phone number</td>
            <td id="phone"></td>
        </tr>
        <tr>
            <td>First Name</td>
            <td id="first_name"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td id="last_name"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td id="email"></td>
        </tr>
        <tr>
            <td>Address</td>
            <td id="address"></td>
        </tr>
    </table>
    <div>
        <button onclick="updateLocalStorage()">تحديث</button>
        <button onclick="deleteData()">حذف</button>
    </div>
</div>

<script>
    // استرجاع البيانات من localStorage وعرضها في الجدول
    document.getElementById('phone').innerText = localStorage.getItem('phone') || '';
    document.getElementById('first_name').innerText = localStorage.getItem('first_name') || '';
    document.getElementById('last_name').innerText = localStorage.getItem('last_name') || '';
    document.getElementById('email').innerText = localStorage.getItem('email') || '';
    document.getElementById('address').innerText = localStorage.getItem('address') || '';

    // تحديث البيانات في localStorage
   /*       let phoneInput = document.querySelector('#phone');
        console.log(phoneInput.textContent); */
function updateLocalStorage(e) {
    // e.privetDefile();




    let confirmButton = document.createElement('button');
    confirmButton.textContent = 'تأكيد';
      let buttonsDiv = document.querySelector('.container div');
    let updateButton = document.querySelector('.container div button');
    buttonsDiv.replaceChild(confirmButton, updateButton);

    // تحويل العناصر <td> التي لديها id إلى حقول إدخال <input>
    let tableCells = document.querySelectorAll('#dataTable td[id]');
    tableCells.forEach(function(cell) {
        let currentValue = cell.innerText.trim(); // قم بإزالة الفراغات الزائدة
        let inputField = document.createElement('input');
        inputField.type = 'text';
        inputField.value = currentValue; // قم بتحقق من القيمة
        
        cell.innerHTML = ''; // تفريغ محتوى الخلية
      if (typeof currentValue !== 'undefined') {
    inputField.value = currentValue;
} else {
    inputField.value = '';
}


        cell.appendChild(inputField); // إضافة حقل الإدخال إلى الخلية
        
        console.log(cell);
        
    });
    
    
    
    confirmButton.onclick = function () {
    let phoneInput = document.querySelector('#phone input');
    let firstNameInput = document.querySelector('#first_name input');
    let lastNameInput = document.querySelector('#last_name input');
    let emailInput = document.querySelector('#email ');
    let addressInput = document.querySelector('#address input');
   
   
        localStorage.setItem('phone', phoneInput.value);
        localStorage.setItem('first_name', firstNameInput.value);
        localStorage.setItem('last_name', lastNameInput.value);
        localStorage.setItem('email', emailInput.value);
        localStorage.setItem('address', addressInput.value);

        location.reload(); // إعادة تحميل الصفحة لعرض البيانات المحدثة
    };

  
}


    // حذف البيانات من localStorage
    function deleteData() {
        localStorage.clear();
        alert('تم حذف البيانات من الذاكرة المؤقتة!');
        window.location="./index.php"
    }
</script>

</body>
</html>
