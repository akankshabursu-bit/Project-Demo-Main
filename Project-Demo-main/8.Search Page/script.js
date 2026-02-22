    
    /******w**************
    
    Assignment 4 Javascript
    Name: Dingguo Du
    Date: 2023/2/5
    Description: Open Data

*********************/
    
    let button = document.querySelector('input.reload');
    let area = document.querySelector('input');
    let message = document.getElementById("message");
    let table = document.getElementById("tab");  
    let body = document.getElementsByTagName("tbody")[0];    
    
    button.addEventListener('click', () => {
        
        tableClear();

        let areaName =document.querySelector('input').value; 

        if(areaName!="")
        {
            let apiUrl = 'https://data.winnipeg.ca/resource/7753-3fjc.json?' +
            `$where=lower(area) LIKE lower('%${areaName}%')` +
            '&$order=votes DESC' +
            '&$limit=100';
        
            let encodedURL = encodeURI(apiUrl); 
    
            fetch(encodedURL)
                .then(function(rawResponse) { 
                    return rawResponse.json(); 
                })
                .then(function(response) {  
    
                        if(response.length>0){
                            message.innerHTML = `${response.length} results have been found for '${areaName}'.`;
                            table.style.display="block";
                        }
                        else{
                            message.innerHTML = "No result was found. Try again!";
                            table.style.display = "none";
                        }
                        
                        if(response.length > 99){    
                            dataPrint(100,response);
                        }
                        else if(response.length < 100 && response.length>0){
                            dataPrint(response.length,response);
                        }
            });
        
        }
        else
        {
            message.innerHTML="Please enter the key words";
            table.style.display = "none";
        }   
    });

    function tableClear(){

        let table = document.getElementById("tab");  
        let body = document.getElementsByTagName("tbody")[0]; 

        if(body !=null)
        {
            table.removeChild(body);
        }
    }

    function dataPrint(number,response){

        let tbody = document.createElement('tbody');

        for(i=0;i<number;i++)
        {
            let row = document.createElement('tr');
            let data1 = document.createElement('td');
            let data2 = document.createElement('td');
            let data3 = document.createElement('td');
            let data4 = document.createElement('td');
            let data5 = document.createElement('td');
            let date = new Date(response[i]['date']);
            data1.innerHTML = date.getFullYear();
            data2.innerHTML = response[i]['area'];
            data3.innerHTML = response[i]['candidate'];
            data4.innerHTML = response[i]['position'];
            data5.innerHTML = response[i]['votes'];
            row.appendChild(data1);
            row.appendChild(data2);
            row.appendChild(data3);
            row.appendChild(data4);
            row.appendChild(data5);
            tbody.appendChild(row);
            table.appendChild(tbody);
        }
    }

   
   


    

    

