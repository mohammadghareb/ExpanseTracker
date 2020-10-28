class Statistic{
  static initializeChart(){
      let formData = new FormData();
      formData.append('section', 'categorygroup');
      fetch('api/index.php', {
        method: 'POST',
        body: formData
      }).then(function (response) {
          response.text().then(function (responseText) {
              responseText = JSON.parse(responseText)
              let categoryNames =[]
              let data = []
              for(let i=0; i<responseText.length; i++){
                  categoryNames.push(responseText[i].category)
                  data.push(responseText[i].amount)
              }
              if(categoryNames.length===0){
                  categoryNames.push('You have no expenses with categories yet')
                  data.push(1)
              }
              var ctx = document.getElementById('myChart').getContext('2d');
              var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
      labels: categoryNames,
      datasets: [{
          label: '# of Votes',
          data: data,
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
      }]
  },
  options: {
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero: true
              }
          }]
      }
  }
});
          });
      });
    }
}
class Expenses{
constructor(category, buyingdate, amount, id){
    this.id = id
    this.category = category
    this.buyingdate = buyingdate
    this.amount=amount
}

static initializeCategory(){
let formData = new FormData();
formData.append('section', 'categorylist');
fetch('api/index.php', {
  method: 'POST',
  body: formData
}).then(function (response) {
    response.text().then(function (responseText) {
      responseText = JSON.parse(responseText);
      let html
      if(responseText.data==='no data'){
        html="<option selected>There's no categories yet, add one in category board</option>"
      }
      else{
        html="<option value='0' selected>Choose a category</option>"
        for(let i=0; i<responseText.length;i++){
          html+="<option value='"+responseText[i].id+"'>"+responseText[i].category+"</option>"
        }
      }
        $('#categoryedit').html(html);
        $('#category').html(html);
        $('#categoryEditBoardSelect').html(html);
        $('#categoryDeleteBoardSelect').html(html);
        
    });
});
}


static initialize(){
  let formData = new FormData();
  formData.append('section', 'listexpenses');
  fetch('api/index.php', {
        method: 'POST',
        body: formData
  }).then(function (response) {
    response.text().then(function (responseText) {
    responseText = JSON.parse(responseText)
    //console.log(responseText.data)
    if(responseText.data.length > 0){
      const expenseTable = document.getElementById('expenseTable');
      expenseTable.innerHTML = '';
      if(responseText.data.length > 0){
          for(let i = 0; i < responseText.data.length; i++){
                expenseTable.appendChild(createDataRow(responseText.data[i]));   
                } }
              
    }
    
      else{
        expenseTable.appendChild(createEmptyRow()); 
      }
    });
});

function createDataRow(expense){
  
      const e = document.createElement.bind(document);
      const expenseRowEl = e('TR');

      const expenseTdTypeEl =e('TD');
      expenseTdTypeEl.textContent = expense.id;
      expenseRowEl.appendChild(expenseTdTypeEl);

      const expenseTdNameEl = e('TD');
      expenseTdNameEl.textContent = expense.category;
      expenseRowEl.appendChild(expenseTdNameEl);

      const expenseTdDateEl = e('TD');
      expenseTdDateEl.textContent = expense.amount;
      expenseRowEl.appendChild(expenseTdDateEl);

      const expenseTdAmountEl = e('TD');
      expenseTdAmountEl.textContent =  expense.buyingdate;
      expenseRowEl.appendChild(expenseTdAmountEl);

      const expenseTdOptionsEl = e('TD');
      const deleteAnchorEl = e('button');
      deleteAnchorEl.textContent = 'Delete';
      deleteAnchorEl.style.color='white';
      deleteAnchorEl.style.backgroundColor='#007bff';

      deleteAnchorEl.onclick = function(e){
        deleteExpense(expense)
        Expenses.reset();
            }
      expenseRowEl.appendChild(deleteAnchorEl);
      return expenseRowEl;
}
function createEmptyRow(){
  const expenseRowEl = document.createElement('TR');       

  const expenseTdTypeEl = document.createElement('TD');
  expenseTdTypeEl.setAttribute('colspan', 5);
  expenseTdTypeEl.textContent = 
      'No expense items yet! Please add one up top...';
  expenseRowEl.appendChild(expenseTdTypeEl);

  return expenseRowEl;
}
function deleteExpense(expense){
  let formData = new FormData();
  formData.append('section', 'deleteexpense');
  formData.append('id', expense.id);
  fetch('api/index.php', {
    method: 'POST',
    body: formData
  }).then(function (response) {
      response.text().then(function (responseText) {
        responseText = JSON.parse(responseText)
        if(responseText.data==='Deleted Successfully!'){
        alert("Deleted Successfully");
        Expenses.reset();}
        else{
          alert("Something went wrong, try again!")
        }
      });
  });
}
function editExpense(expense){
  let formData = new FormData();
  formData.append('section', 'editexpense');
  formData.append('id', expense.id);
  formData.append('amount', expense.amount);
  formData.append('buyingdate', expense.buyingdate);
  formData.append('category', expense.category);
  fetch('api/index.php', {
    method: 'POST',
    body: formData
  }).then(function (response) {
    response.text().then(function (responseText) {
      responseText = JSON.parse(responseText)
      if(responseText.data==='Edited Successfully!'){
      alert("Edited Successfully");
      Expenses.reset();}
      else{
        alert("Something went wrong, try again!")
      }
    });
});
}
    }

static reset(){
    Expenses.initialize();
    Expenses.initializeCategory();
    Statistic.initializeChart()
}
static addExpense(expense){
//console.log(expense)
          let formData = new FormData();
          formData.append('section', 'addexpense');
          formData.append('amount', expense.amount);
          formData.append('buyingdate', expense.buyingdate);
          formData.append('category', expense.category);
          fetch('api/index.php', {
            method: 'POST',
            body: formData
          }).then(function (response) {
            response.text().then(function (responseText) {
              responseText = JSON.parse(responseText)
              if(responseText.data==='success'){
              alert("Added Successfully");
              Expenses.reset();}
              else{
                alert("This category already exists!")
              }
            });
        });
      }

static addCategory(category){
  let formData = new FormData();
  formData.append('section', 'addcategory');
  formData.append('category', category.category);
  fetch('api/index.php', {
    method: 'POST',
    body: formData
  }).then(function (response) {
      response.text().then(function (responseText) {
        responseText = JSON.parse(responseText)
        if(responseText.data==='success'){
        alert("Added Successfully");
        Expenses.initializeCategory();}
        else{
          alert("This category already exists!")
        }
      });
  });
}         
    }

Expenses.initialize();
Expenses.initializeCategory();
Statistic.initializeChart()
$('#expensefor').on('submit', function (event) {
    event.preventDefault();
    let date = document.getElementById('buyingDate').value.toString();
    let expense = new Expenses($('#category option:selected').text(),date,$('#amount').val())
    console.log(expense)
    Expenses.addExpense(expense)
    document.getElementById('expensefor').reset()
  });

  $('#addCategoryForm').on('submit', function (event) {
    event.preventDefault();
    let category = document.getElementById('addCategoryInput').value
    category = new Expenses(category)
    console.log(category)
    Expenses.addCategory(category)
    document.getElementById('addCategoryForm').reset()
  });
