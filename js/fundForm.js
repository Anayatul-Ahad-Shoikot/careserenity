function showForm(clicked) { 
    const form = document.querySelector('.FundForm');
    const MyFunds= document.querySelector('.MyFunds');
    const FundList= document.querySelector('.FundList');

    if(form.style.display == 'block'){
        form.style.display = 'none';
        clicked.innerHTML = "Fund+"; 
        MyFunds.style.display = 'block';
        FundList.style.display = 'block';

    } else {
        form.style.display = 'block';
        clicked.innerHTML = 'Cancel Form'; 
        MyFunds.style.display = 'none';
        FundList.style.display = 'none';
    }
}