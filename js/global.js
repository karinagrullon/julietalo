// JavaScript Document


function imposeMaxLength(Object, MaxLen)
{
  return (Object.value.length <= MaxLen);
}

function full_url(){
alert( document.URL );
}

//TAMANOS CON CANTIDADES

var z=0,jj=0;
var s1= new Array();
var checkbox = document.getElementsByName('sizes[]');

function checksizes() {

var ln = 0;
for (var i=0; i< checkbox.length; i++) {
    if(checkbox[i].checked == false) {
 //alert(parseInt(checkbox[i].value, 10));
//Create hidden
z++;
s1[z]=document.createElement('input');
s1[z].type='text';
s1[z].name='sizqua[]';
s1[z].value = '0';
s1[z].size = 50;
s1[z].id= 'input-feat';

 document.getElementById('si1').appendChild(s1[z]);
 
  var br1 = document.createElement("br");
  br1.id= 'br-size';
        var foo1 = document.getElementById('si1');
         foo1.appendChild(br1);
	// //End create hidden
        ln++
	}
}
}

//END TAMANOS CON CANTIDADES

<!--FEATURES
var i=0,j=0;
var t1= new Array();



window.onload = function firsttext(){
i++;
t1[i]=document.createElement('input');
t1[i].type='text';
t1[i].name='feats[]';
t1[i].value = '';
t1[i].id= 'input-feat';

document.getElementById('td1').appendChild(t1[i]);
var br = document.createElement("br");
var foo = document.getElementById('td1');
//foo.appendChild(br);
}

function createtext(){
i++;
t1[i]=document.createElement('input');
t1[i].type='text';
t1[i].name='feats[]';
t1[i].value = '';
t1[i].size = 50;
t1[i].id= 'input-feat';

//document.forms[0].appendChild(t1[i]);
 document.getElementById('td1').appendChild(t1[i]);
 
  var br = document.createElement("br");
  br.id= 'br-feat';
        var foo = document.getElementById('td1');
         foo.appendChild(br);
		t1[i].focus();
}



var h=0,j=0;
var t2= new Array();
var length = javascript_array.length;


window.onload = function updatetext(){

for (var u = 0; u < length; u++) {
h++;	
t2[h] =document.createElement('input');
t2[h].type ='text';
t2[h].name ='feats[]';
t2[h].value = javascript_array[u];
t2[h].size = 50;
t2[h].id= 'input-feat';

 document.getElementById('td1').appendChild(t2[h]);
 
  var br = document.createElement("br");
        var foo = document.getElementById('td1');
        foo.appendChild(br);
		
 }

}


//Login box

// function showForm(){
    // document.getElementById('loginForm').style.display = "block";
// }

// function hideForm(){
    // document.getElementById('loginForm').style.display = "none";
// } 


//confirm

function button_confirm()
{
return confirm('Are you sure you want to delete this?');
}



// window.onload = function () { 
// alert("It's loaded!"); 
// // window.location.hash="success";
// }




						  