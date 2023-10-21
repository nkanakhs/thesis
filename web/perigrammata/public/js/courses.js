$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');

});


// DATATABLES INITIALIZATION



// admin edit Learning outcomes
$(document).ready(function () {
    $('#adminLo').DataTable({
    "searching": true, // false to disable search (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});

// dtAllOutcomes
$(document).ready(function () {
    $('#dtAllOutcomes').DataTable({
    "searching": true, // false to disable search (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});

// studentCheckCourses
$(document).ready(function () {
    $('#studentCheckCourses').DataTable({
    "searching": false, // false to disable search (or any other option)
    "paging": false // false to disable pagination (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});
// studentOptCourses
$(document).ready(function () {
    $('#studentOptCourses').DataTable({
    "searching": true, // false to disable search (or any other option)
    "paging": false // false to disable pagination (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});
//Documented Learning Outcomes
$(document).ready(function () {
    $('#dtDocumentedLearningOutcomes').DataTable({
    "searching": true // false to disable search (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});

//Learning outcomes
$(document).ready(function () {
    $('#dtLearningOutcomes').DataTable({
    "searching": true // false to disable search (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});
// Basic example
$(document).ready(function () {
    $('#dtBasicExample').DataTable({
    "searching": true // false to disable search (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});
//For datatable allusers  dtAllUser
$(document).ready(function () {
    $('#dtAllUser').DataTable({
    "searching": true // false to disable search (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});
//For datatable EnglishVebs dtEnglishVerbs
$(document).ready(function () {
    $('#dtEnglishVerbs').DataTable({
    "searching": true // false to disable search (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});
//For datatable GreekVebs dtGreekdtGreekVerbsVerbs
$(document).ready(function () {
    $('#dtGreekVerbs').DataTable({
    "searching": true // false to disable search (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
});



$(document).ready(function(){
    $( ".ActivityHours" ).change(function() {

        ActivityId = this.id.replace("activity_", "");
        calc_sum( ActivityId, true )
      });
    calc_sum( "", false );

    $( ".skill_list" ).change(function() {
        calc_sum( "", false )
    });


   
  $('#learning_outcomes_form').on('keyup keypress', function(e) {
       var keyCode = e.keyCode || e.which;
       if (keyCode === 13) { 
        e.preventDefault();
         return false;
       }
  });
    
      $( ".activity_error" ).hide();
    
    $( "tbody#sortable" ).sortable();
    
    // $( "tbody#sortable_" ).sortable();
});
//Copy div to clipboard (Html page)
function CopyToClipboard(containerid) {

    if (document.selection) { 
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select().createTextRange();
        document.execCommand("copy");     

    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().addRange(range);
        document.execCommand("copy");
        alert("text copied") 
    }
}

function loadContent(page) {
    // Send an AJAX request to the PHP controller
    //alert(page);
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", page, true);
    xhttp.send();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Update the main content area with the returned content
        var response = JSON.parse(this.responseText);
        document.getElementById("main-content").innerHTML = response.content;
      }
    };
  }

$(".datepick").datepicker();


function deleteMethod(methodNumber)
{
    var a = document.getElementById("MethodId_"+methodNumber);
    a.innerHTML = "";
    var b = document.getElementById("numOfmethods");
    var c = b.value -1;
    b.setAttribute("value", c);
    
    var form = document.getElementById("learningOutcomes").submit();
    removePartnersOnMethodDelete(methodNumber);
    
}

function studentdropdown()
{
    var a = document.getElementById("studentgrades");
    
    var lang = document.getElementById("language");
    
    a.removeAttribute("active");

    a.removeAttribute("onclick");
    a.setAttribute("onclick", "closegrades()");

    var ajax_request = new XMLHttpRequest();

    var studentId = document.getElementById("studentId");
    var courseId = document.getElementById("courseId");
    ajax_request.open("GET", "get_assessments?studentId="+studentId.value+"&courseId="+courseId.value+"&language="+lang.value,true);

    ajax_request.send();

    var ptr= '';
    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            var response = JSON.parse(ajax_request.responseText);

            for(var count=0; count < response.length; count++)
            {
                ptr += '<a class="list-group-item list-group-item-action px-5" href="#grade'+response[count].categoryId+'" id="drop'+response[count].categoryId+'" data-toggle="list" role="tab" aria-controls="'+response[count].categoryName+'">'+response[count].categoryName+'</a>';
            }
        }
        a.insertAdjacentHTML('afterend', ptr);
    }
}

function closegrades()
{

    var ptr = document.getElementById("drop1");
    var ptr2 = document.getElementById("drop2");
    var ptr3 = document.getElementById("drop3");
    var ptr4 = document.getElementById("drop4");
    var ptr5 = document.getElementById("drop5");
    var ptr6 = document.getElementById("drop6");
    var ptr7 = document.getElementById("drop7");
    var ptr8 = document.getElementById("drop8");
    var parent = document.getElementById("list-tab");

    if(ptr!=null){
        parent.removeChild(ptr);
    }
    if(ptr2!=null){
        parent.removeChild(ptr2);
    }
    if(ptr3!=null){
        parent.removeChild(ptr3);
    }
    if(ptr4!=null){
        parent.removeChild(ptr4);
    }
    if(ptr5!=null){    
        parent.removeChild(ptr5);
    }
    if(ptr6!=null){
        parent.removeChild(ptr6);
    }
    if(ptr7!=null){    
        parent.removeChild(ptr7);
    }
    if(ptr8!=null){    
        parent.removeChild(ptr8);
    }

    var ptr3 = document.getElementById("studentgrades");
    ptr3.setAttribute("onclick", "studentdropdown()");
}

function addNumbers(){
    var a = document.getElementById("js-lectures").value ;
    var b = document.getElementById("js-laboratories").value ;
    var c = document.getElementById("js-tutorials").value ;
    var d = document.getElementById("js-lab-tutorials").value ;
    var x = +a + +b + +c + +d ;

    document.getElementById("js-total_sum").value  = x;
}

function load_data(query)
{
    if(query.value.length >2)
    {
        var form_data = new FormData();
        
        var courseId = document.getElementById('courseId');

        form_data.append('query', query);

        var ajax_request = new XMLHttpRequest();
        
        ajax_request.open("GET", "get_users?query="+query.value+"&courseId="+courseId.value,true);

        ajax_request.send();

        ajax_request.onreadystatechange = function()
        {

            if (ajax_request.readyState == 4 && ajax_request.status == 200)
            {   
                var response = JSON.parse(ajax_request.responseText);
                //alert(response[0].Id);
                //alert(response.length);
                var html = '<div class= "list-group py-1">';
                if(response.length > 0)
                {
                    for (var count=0; count < response.length; count++)
                    {   

                        //alert(response[count].id);
                        newresponse = response[count].firstname;
                        newresponse2 = response[count].lastname;
                        $regEX = new RegExp(query.value, 'i');

                        str = '<span style="font-weight: bold">' + query.value +'</span>';
                        newresponse = response[count].firstname.replace($regEX, str);
                                            
                        //newresponse.split(" ");

                        //newresponse[0].toUpperCase();    
                        //newresponse[1].toUpperCase();
                        
                        str2 = '<span style="font-weight: bold">' + query.value +'</span>';
                        newresponse2 = response[count].lastname.replace($regEX , str2); 
                        
                        //newresponse2.split(" ");

                        //newresponse2[0].toUpperCase();    
                        //newresponse2[1].toUpperCase();

                        exists = document.getElementById('p_'+response[count].id);

                        if(exists==null)
                        {
                            html +='<a href="#" class="px-2 list-group-item list-group-item-action " onclick="getPartners(this);" id="'+response[count].id+'" value="'+response[count].firstname +'">'
                                        +newresponse + " " + newresponse2+'</a>';
                        }else if( exists && exists.value == response[count].id)
                        {
                            html +='<a href="#" class="px-2 list-group-item list-group-item-action disabled" onclick="getPartners(this);" id="'+response[count].id+'" value="'+response[count].firstname +'">'
                                        +newresponse + " " + newresponse2+'</a>';
                        }else
                        {
                            html +='<a href="#" class="px-2 list-group-item list-group-item-action " onclick="getPartners(this);  " id="'+response[count].id+'" value="'+response[count].firstname +'">'
                                        +newresponse + " " + newresponse2+'</a>';
                        }
                        
                    }
                }
                else
                {
                    html += '<a href="#" class="list-group-item list-group-item-action disabled">No Data Found </a>';
                }

                html += '</div>';

                document.getElementById('search_result').innerHTML = html;
            }
        }
    }
    else
    {
        document.getElementById('search_result').innerHTML= '';
    }
}


function getPartners(event)
{
    
    var language = document.getElementById("language");
    string = event.textContent;

    string.split(" ");

    string[0].toUpperCase();    
    string[1].toUpperCase();

    document.getElementsByName('search_box')[0].value = string;

    document.getElementById('search_result').innerHTML = '';

    var html = '<div class="text-center">';
    html += '<input type="text" name="partnersName[]" id="pname_'+event.id+'" value="'+string+'" title="ParnterName[]" placeholder="selected partner" style="width:200px;" readonly/>';
    html += '<input type="hidden" name="partnersId[]" id="p_'+event.id+'" value="'+event.id+'" />';
    if(language.value == 'gr'){
        html += '<button type="button" name="remove" id="pbutton_'+event.id+'" onclick="removePartner('+event.id+')" class="rmbutton">Αφαίρεση</button>';
    }else{
        html += '<button type="button" name="remove" id="pbutton_'+event.id+'" onclick="removePartner('+event.id+')" class="rmbutton">Remove</button>';
    }
    html += '</div>';
    
    var ajax_request = new XMLHttpRequest();
    
    courseID= document.getElementById('courseID').value;

    ajax_request.open("GET", "SubmitPartners?id="+event.id+"&courseId="+courseID,true);

    ajax_request.send();

    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            div=document.getElementById('js-partners');

            div.insertAdjacentHTML('beforeend' , html);
        }
    }
}

function removePartner(ev)
{   
    var ajax_request = new XMLHttpRequest();
    
    courseID= document.getElementById('courseID').value;

    ajax_request.open("GET", "RemovePartners?id="+ev+"&courseId="+courseID,true);

    ajax_request.send();

    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {  
            pname= "pname_" + ev;
            pid = "p_" +ev;
            pbutton= "pbutton_" + ev;
            document.getElementById(pname).remove();
            document.getElementById(pid).remove();
            document.getElementById(pbutton).remove();
        }
    }
}

//for loading partners on select
function loadPartners(num,num2,num3)
{

    var ajax_request = new XMLHttpRequest();

    courseID= document.getElementById('courseID').value;
    
    ajax_request.open("GET", "loadPartners?courseID="+courseID,true);

    ajax_request.send();

    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {  
            var response = JSON.parse(ajax_request.responseText);

            if(response.length > 0)
            {
                var html = '<div>';
                
                html += "<option>Επιλέξτε Καθηγητή...</option>";
                for (var count=0; count < response.length; count++)
                {
                    //alert(response[count].firstname +" "+ response[count].lastname);
                    if(document.getElementById("partnername_"+response[count].id+num+num2+num3) != null)
                    {
                        html += '<option value="' + response[count].id+ '" disabled>'+response[count].firstname +" "+ response[count].lastname+ "</option>";
                    }
                    else
                    {
                        html += '<option value="' + response[count].id+ '">'+response[count].firstname +" "+ response[count].lastname+ "</option>";
                    }        
                }
                html += '</div>';
                
                //div.insertAdjacentHTML('beforeend',html);
            }
            document.getElementById('select_'+num+num2+num3).innerHTML = html;
        }
    }
}

//to insert partner at specific method,assessment and subcategory
function insertPartner(num,num2,num3)
{
    
    var pid = document.getElementById("select_"+num+num2+num3);
    var language = document.getElementById("language");

    var PartnerId = pid.options[pid.selectedIndex].value;
    var PartnerName = pid.options[pid.selectedIndex].text;

    var new_partner = '<div class="text-center" >';
    new_partner += '<input type="text" name="PartnerName[]" id="partnername_'+PartnerId+num+num2+num3+'" value="'+PartnerName+'" title="PartnerName[]" placeholder="selected partn" style="width:200px;" readonly/>';
    new_partner += '<input type="hidden" name="PartnerId[]" id="partnerid_'+PartnerId+num+num2+num3+'" value="'+PartnerId+'" />';
    if(language.value == 'gr'){
        new_partner += "<button type='button' name='remove' id='partnerbutton_"+PartnerId+num+num2+num3+"' class='rmbutton' onclick='removePartnerSpecific("+PartnerId+","+num+","+num2+","+num3+")'>Αφαίρεση</button></div>";
    }else{
        new_partner += "<button type='button' name='remove' id='partnerbutton_"+PartnerId+num+num2+num3+"' class='rmbutton' onclick='removePartnerSpecific("+PartnerId+","+num+","+num2+","+num3+")'>Remove</button></div>";
    }
    courseID= document.getElementById('courseID').value;
    
    var ajax_request = new XMLHttpRequest();

    ajax_request.open("GET", "SubmitPartnersSpecific?partnerId="+PartnerId+"&courseId="+courseID+"&method="+num+"&assessment="+num2+"&subcategoryId="+num3,true);

    ajax_request.send();

    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            
            div = document.getElementById( 'js-partners'+num+num2+num3);

            div.insertAdjacentHTML( 'beforeend', new_partner );
        }
    }

}

//to remove partner from specific method,assessment and subcategory
function removePartnerSpecific(id,methodnum,assessmentId,subcategoryId)
{

    var ajax_request = new XMLHttpRequest();
    
    courseID= document.getElementById('courseID').value;

    ajax_request.open("GET", "RemovePartnersSpecific?partnerId="+id+"&courseId="+courseID+"&methodnum="+methodnum+"&assessmentId="+assessmentId+"&subcategoryId="+subcategoryId,true);

    ajax_request.send();

    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {  
            pname= "partnername_" +id+methodnum+assessmentId+subcategoryId;
            pid = "partnerid_" +id+methodnum+assessmentId+subcategoryId;
            pbutton= "partnerbutton_" +id+methodnum+assessmentId+subcategoryId;
            document.getElementById(pname).remove();
            document.getElementById(pid).remove();
            document.getElementById(pbutton).remove();
        }
    }

}

function removePartnersOnMethodDelete(methodnum){
    var ajax_request = new XMLHttpRequest();
    
    courseID= document.getElementById('CourseId').value;

    ajax_request.open("GET", "RemovePartnersOnMethodDelete?&courseId="+courseID+"&methodnum="+methodnum,true);

    ajax_request.send();

    ajax_request.onreadystatechange = function()
    {
        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {  
        }
    }

}

function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }


function addProfessors2(cnt){
    var language = document.getElementById("language");
    var cnt = document.getElementById("counter");
    //alert("counter html"+cnt.value);
    var pid = document.getElementById("js-Professor");
    var ProfessorId = pid.options[pid.selectedIndex].value;
    var ProfessorName = pid.options[pid.selectedIndex].text;
    if(ProfessorName==""){
        return;
    }
    pid.options[pid.selectedIndex].disabled = true;
    //alert(+ProfessorName);

    var new_prof = '<div class="text-center" id="js-professors'+cnt.value+'">';
    new_prof += '<input type="text" name="ProfessorName[]" id="pname_'+pid.selectedIndex+'" value="'+ProfessorName+'" title="ProfessorName[]" placeholder="selected prof" style="width:200px;" readonly/>';
    new_prof += '<input type="hidden" name="ProfessorId[]" id="pid_'+pid.selectedIndex+'" value="'+ProfessorId+'" />';
    if(language.value == 'gr'){
        new_prof += "<button type='button' name='remove' id='pbutton_"+pid.selectedIndex+"' class='rmbutton' onclick='removeProfessors2("+pid.selectedIndex+","+cnt.value+")'>Αφαίρεση</button>";
    }else{
        new_prof += '<button type="button" name="remove" id="pbutton_'+pid.selectedIndex+'" class="rmbutton" onclick="removeProfessors2('+pid.selectedIndex+','+cnt.value+')">Remove</button>';
    }
    new_prof += '</div>';
    div = document.getElementById( 'js-profs');
    div.insertAdjacentHTML( 'beforeend', new_prof );
    
    pid.selectedIndex=0;
    cnt.value++;
}


function removeProfessors2(selected_Index, k){
    var pid = document.getElementById("js-Professor");
    
    pid.options[selected_Index].disabled = false;

    var parent = document.getElementById("js-professors"+k);
    var child = document.getElementById("pname_"+selected_Index);
    parent.removeChild(child);

    var child = document.getElementById("pid_"+selected_Index);
    parent.removeChild(child);

    
    var child = document.getElementById("pbutton_"+selected_Index);
    parent.removeChild(child);
}

function addProfessors(){
    var pid = document.getElementById("js-Professor");
    var ProfessorId = pid.options[pid.selectedIndex].value;
    var ProfessorName = pid.options[pid.selectedIndex].text;
    if(ProfessorName==""){
        return;
    }
    pid.options[pid.selectedIndex].disabled = true;
    //alert(+ProfessorName);

    var new_prof = '<input type="text" name="ProfessorName[]" id="pname_'+pid.selectedIndex+'" value="'+ProfessorName+'" readonly/>';
    new_prof += '<input type="hidden" name="ProfessorId[]" id="pid_'+pid.selectedIndex+'" value="'+ProfessorId+'" />';
    new_prof += '<button type="button" name="remove" id="pbutton_'+pid.selectedIndex+'" class="btn btn-sm js-table-row-remove" onclick="removeProfessors('+pid.selectedIndex+')">-</button>';
    
    div = document.getElementById( 'js-professors' );
    div.insertAdjacentHTML( 'beforeend', new_prof );
}

function removeProfessors(selected_Index){
    
    var pid = document.getElementById("js-Professor");
    
    pid.options[selected_Index].disabled = false;

    var parent = document.getElementById("js-professors");
    var child = document.getElementById("pname_"+selected_Index);
    parent.removeChild(child);

    var child = document.getElementById("pid_"+selected_Index);
    parent.removeChild(child);

    
    var child = document.getElementById("pbutton_"+selected_Index);
    parent.removeChild(child);
}

//function to create a new row on the table for the excercises etc...
function addRow(courseId, method , assId ) {
    var number = document.getElementById('number');
    var table = document.querySelector('table');
    var tbody = table.querySelector('tbody');
    var rowCount = tbody.getElementsByTagName('tr').length;
    var newRow = document.createElement('tr');
    
    var newNumberCell = document.createElement('td');
    newNumberCell.textContent = rowCount + 1;
    newRow.appendChild(newNumberCell);
    var newPercentageCell = document.createElement('td');
    var newPercentageInput = document.createElement('input');
    newPercentageInput.setAttribute('type', 'text');
    newPercentageInput.setAttribute('id', 'percentage'+number.value);
    newPercentageInput.setAttribute('value', '');
    newPercentageInput.addEventListener('input', function(event) {
        const newValue = event.target.value;
        newPercentageInput.setAttribute('value', newValue); 
        // Do something with the new value, e.g. set it to a variable or call a function
      });
    newPercentageInput.setAttribute('onchange', 'changePercentage('+courseId+','+ method +','+ assId+','+number.value+')');
    newPercentageCell.appendChild(newPercentageInput);
    newRow.appendChild(newPercentageCell);
    
    var newButtonCell = document.createElement('td');
    var newButton = document.createElement('button');
    newButton.setAttribute('onclick', 'RemoveRow('+courseId+','+ method +','+ assId+','+number.value+')');
    var lang = document.getElementById('language');
    if (lang.value == 'en'){
        newButton.textContent = 'Remove';
    }else{
        newButton.textContent = 'Αφαίρεση';
    }
    newButton.setAttribute('class', 'rmbutton');
    newButton.setAttribute('id', 'remove'+number.value);
    
    newButtonCell.appendChild(newButton);
    newRow.appendChild(newButtonCell);
    
    number.value++;
    tbody.appendChild(newRow);
  }

  
function changePercentage(courseId, method , assId , number)
{
    //var input = document.getElementById('percentage'+number);
    //input.addEventListener('input', function(event) {
       // const newValue = event.target.value;
       // input.setAttribute('value', newValue); 
        // Do something with the new value, e.g. set it to a variable or call a function
      //});
    var percentage = document.getElementById('percentage'+number).value;
    var ajax_request = new XMLHttpRequest();

    ajax_request.open("GET", "addAssessmentNumber?CourseId="+courseId+"&method="+method+"&assessment="+assId+"&assessmentNumber="+number+"&percentage="+percentage,true);

    ajax_request.send();

    ajax_request.onreadystatechange = function()
    {
        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
        }
    }
}

function changeOldPercentage(courseId, method , assId , number)
{
    var percentage = document.getElementById('percentage'+number).value;
    var ajax_request = new XMLHttpRequest();

    ajax_request.open("GET", "updateAssessmentNumber?CourseId="+courseId+"&method="+method+"&assessment="+assId+"&assessmentNumber="+number+"&percentage="+percentage,true);

    ajax_request.send();

    ajax_request.onreadystatechange = function()
    {
        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
        }
    }
}

function RemoveRow(courseId, method , assId ,num)
{
    
    var remove= document.getElementById('remove'+num);
    const row = remove.parentNode.parentNode;
    const table = row.parentNode;
    table.removeChild(row);

    var ajax_request = new XMLHttpRequest();

    ajax_request.open("GET", "DeleteAssessmentSpecific?CourseId="+courseId+"&method="+method+"&assessment="+assId+"&assessmentNumber="+num,true);

    ajax_request.send();

    ajax_request.onreadystatechange = function()
    {
        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {  
             location.reload();
        }
    }
}

function addPrerequisites(){
    var prid = document.getElementById("js-Prerequisites");
    var PrerequisiteId = prid.options[prid.selectedIndex].value;
    var CourseName = prid.options[prid.selectedIndex].text;
    if(CourseName==""){
        return;
    }
    prid.options[prid.selectedIndex].disabled = true;

    var new_requiredCourse = '<input type="text" name="CourseName[]" id="prname_'+prid.selectedIndex+'" value="'+CourseName+'" readonly/>';
    new_requiredCourse += '<input type="hidden" name="PrerequisiteId[]" id="prid_'+prid.selectedIndex+'" value="'+PrerequisiteId+'" />';
    new_requiredCourse += '<button type="button" name="remove" id="prbutton_'+prid.selectedIndex+'" class="btn btn-sm js-table-row-remove" onclick="removePrerequisites('+prid.selectedIndex+')">-</button>';
    
    div = document.getElementById( 'js-courses' );
    div.insertAdjacentHTML( 'beforeend', new_requiredCourse );
}

function removePrerequisites(selected_Index){
    
    var prid = document.getElementById("js-Prerequisites");
    
    prid.options[selected_Index].disabled = false;

    var parent = document.getElementById("js-courses");
    var child = document.getElementById("prname_"+selected_Index);
    parent.removeChild(child);

    var child = document.getElementById("prid_"+selected_Index);
    parent.removeChild(child);

    var child = document.getElementById("prbutton_"+selected_Index);
    parent.removeChild(child);
}


function calc_sum( ActivityId, notice )
{
    $( ".totalHours_warning" ).hide();
    var sum = 0;
    $('.ActivityHours').each(function(i, obj) {
        sum += Number(this.value);
    });
    $( ".totalHours" ).val(sum);
    min_totalHours = $( "#min_totalHours" ).val();
    if( sum < min_totalHours )
    {
        $( ".totalHours_warning" ).show();        
    }

    if( ActivityId != "" && act_hours != "" && act_hours != 0 )
    {
        var act_hours = $( "#activity_" + ActivityId ).val();
        act_hours.replace( " ", "" );
        
        if( act_hours != "" && act_hours != 0 )
        {

            $.post({
                url: url + 'ProfessorController/getActivitySkill',
                data: {ActivityId: ActivityId},
                error: function() {
                    //$('#info').html('<p>An error has occurred</p>');
                },
                dataType: 'json',
                success: function(data) {

                    var missing = "";
                    $.each( data, function( key, value ) {
                        
                        if(document.getElementById('skill_' + value.SkillId).checked) {
                            missing = "";
                            return false;
                        } else {
                            missing += "\n -" + value.Description
                        }
                    });
                    
                    $( ".activity_error" ).hide();
                    $("#finish_creation").prop("disabled",false);
                    if( missing != "" )
                    {
                        // $( ".activity_error" ).show();
                        // $("#finish_creation").prop("disabled",true);
                        
                        if( notice == true )
                        {

                       
                            alert("Based on your choice of workload of education activities (section 4), in the Generic Skills field, you must choose one of the following: \nΣύμφωνα με τις επιλογές σας σε δραστηριότητες στην οργάνωση διδασκαλίας (περιοχή 4 της φόρμας), στις Γενικές Ικανότητες πρέπει να επιλέξετε κάποιο από τα παρακάτω: \n " + missing);
                            //alert("You have to choose any of the above: \n" + missing)
                        }
                    }    
                }
            });
        }
        else
        {
            $( ".activity_error" ).hide();
            $("#finish_creation").prop("disabled",false);
        }
    }
}

function totalSum(){
    return document.getElementById('totalScore').value = sum;
}

function handleChange(input) {
    if (input.value < 0) input.value = 0;
    if (input.value > 100) input.value = 100;

    var sum = 0;
    document.getElementById('percent1').value = input.value;

    $('.percent').each(function(i, obj) {
        if(i <=7)
        {
            sum += Number(this.value);
            document.getElementById('totalScore').value = sum;
        }
    });
    
    if( sum != 100 )
    {
        if($('#languageId').value == 'en'){
            $('.percent').tooltip({'title': 'Attention: Τhe summative assessment scores do not sum up to 100.'});
        }else{
            $('.percent').tooltip({'title': 'Προσοχή: Η αθροιστική αξιολόγηση δεν αθροίζει στο 100.'});
        }
    }
    if (sum>100){
        if($('#languageId').value == 'en'){
            alert( "Attention: Τhe summative assessment scores do not sum up to 100. It is: " + sum );

        }else{
            alert( "Προσοχή: Η αθροιστική αξιολόγηση δεν αθροίζει στο 100. Είναι: " + sum );

        }
    }
}



//delete row from learning outcomes
$("#outcomes_table").on('click', '.btn-remove', function () {
    $(this).closest('tr').remove();
});


//Fill circle progress bar Admin-Documented Learning Outcomes
$(function() {

    $(".progress1").each(function() {
  
      var value = $(this).attr('data-value');
      var left = $(this).find('.progress-left .progress-bar1');
      var right = $(this).find('.progress-right .progress-bar1');
  
      if (value > 0) {
        if (value <= 50) {
            // right.css('transition', 'all 0.4s ease-in')
           
          right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
        } else {
            
          right.css('transform', 'rotate(180deg)')
          left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
        }
      }
  
    })
  
    function percentageToDegrees(percentage) {
  
      return percentage / 100 * 360
  
    }
  
  });

//   function myFunction() {
//     document.getElementById("myprogressbar").style.transition = "all 2s";
//   }
function myJavaScriptFunction() {
   // define a new variable
    alert ('Saved succesfully!')
}

function myFunction_() {
   
    var x = document.getElementById("getDname").value;
 
    // document.getElementById("output").value=document.getElementById("getDname").value;
    // window.location.href = url+"StudentController/StudentPage2?name=" + x;
    var loan = +document.getElementById("getDname").value;
    // document.getElementById('numpay').textContent = loan; 

    // document.getElementsById("studentCheckCourses_filter").value ="Αγγ";
    if(x != ''){
        document.getElementById("admDivCheck").style.display = "block";
    }
    else{
        document.getElementById("admDivCheck").style.display = "none";
    }
}

// $.post(url, {data: document.getElementById('numpay').innerHTML});

function checkRequired() {
    if ($('input[type=checkbox]:checked').length > 0) {  // the "> 0" part is unnecessary, actually
        $('input[type=checkbox]').prop('required', false);
    } else {
        $('input[type=checkbox]').prop('required', true);
    }

}
function getStudChoice() {
    var x = document.getElementById("getStudentChoice").value;
    // var x1 = document.getElementById("getDname").value;
    if(x == 1 ){
        document.getElementById("stud_choice2_div").style.display = "none";
        document.getElementById("stud_choice1_div").style.display = "block";  
        document.getElementById("stud_choice3_div").style.display = "none";
        // document.getElementById("stud_choice2_div").classList.add("hide");  
        // document.getElementById("stud_choice1_div").classList.remove("hide"); 
    }else if(x == 2 ){
        document.getElementById("stud_choice1_div").style.display = "none";
        document.getElementById("stud_choice2_div").style.display = "block";
        document.getElementById("stud_choice3_div").style.display = "none";
        // document.getElementById("stud_choice1_div").classList.add("hide");  
        // document.getElementById("stud_choice2_div").classList.remove("hide"); 
    }else if(x == 3 ){
        document.getElementById("stud_choice1_div").style.display = "none";
        document.getElementById("stud_choice2_div").style.display = "none";
        document.getElementById("stud_choice3_div").style.display = "block";
        // document.getElementById("stud_choice1_div").classList.add("hide");  
        // document.getElementById("stud_choice2_div").classList.remove("hide"); 
    }
    else{
        document.getElementById("stud_choice1_div").style.display = "none";
        document.getElementById("stud_choice2_div").style.display = "none";
        document.getElementById("stud_choice3_div").style.display = "none";
        // document.getElementById("stud_choice1_div").classList.add("hide");  
        // document.getElementById("stud_choice2_div").classList.add("hide");  
    }
}


// Table switch button
var e = document.getElementById("optional-courses"),
    d = document.getElementById("all-courses"),
    t = document.getElementById("switcher"),
    m = document.getElementById("optional_courses"),
    y = document.getElementById("all_courses");
if(e){
    e.addEventListener("click", function(){
        t.checked = false;
        e.classList.add("toggler--is-active");
        d.classList.remove("toggler--is-active");
        m.classList.remove("hide");
        y.classList.add("hide");
    });
}

if(d){
    d.addEventListener("click", function(){
    t.checked = true;
    d.classList.add("toggler--is-active");
    e.classList.remove("toggler--is-active");
    m.classList.add("hide");
    y.classList.remove("hide");
    });
}

if(t){
t.addEventListener("click", function(){
  d.classList.toggle("toggler--is-active");
  e.classList.toggle("toggler--is-active");
  m.classList.toggle("hide");
  y.classList.toggle("hide");
})
}
// --
$(document).ready(function() {
	"use strict";
	
	// OPEN MODAL ON TRIGGER CLICK
	$(".quickViewTrigger").on('click', function () {
		var $quickview = $(this).next(".quickViewContainer");
		$quickview.dequeue().stop().slideToggle(500, "easeInOutQuart");
		$(".quickViewContainer").not($quickview).slideUp(200, "easeInOutQuart");
	});
	
	// CLOSE MODAL WITH MODAL CLOSE BUTTON
	$(".close").click(function() {
		$(".quickViewContainer").fadeOut("slow");
	});
	
});

// CLOSE MODAL ON ESC KEY PRESS
$(document).on('keyup', function(e) {
	"use strict";
	if (e.keyCode === 27) {
		$(".quickViewContainer").fadeOut("slow");
	}
});

// CLOSE MODAL ON CLICK OUTSIDE MODAL
$(document).mouseup(function (e) {
	"use strict";
    var container = $(".quickViewContainer");
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $('.quickViewContainer').fadeOut("slow");
    }
});

$('#stud_all').on('show.bs.modal', function(e) {
    var product = $(this).data('id');
    $(".modal-body #product_name").val(product);
  });

//   var lockbtn = document.getElementById("lock");
    
//   lockbtn.onclick = function() {
//     console.log(lockbtn.value);

//   }

function getOccurrence(array, value) {
    return array.filter((v) => (v === value)).length;
}


function validation(sel)
{
    // Id poy yparxoyn hdh
    var id = document.getElementsByClassName("myselect");
    var errormsg = document.getElementById("errormsg");
    var counter = 0,pos =0;
    
    for(var i=0;i<id.length;i++){
        if(id[i].value!='' && id[i].value==sel.value){
            counter++;
        }
        for(var j=0;j<id.length;j++){
            if(id[i].value!='' && id[i].value ==id[j].value && i!=j){
                counter++;
            }
        }
    }

    // console.log(occurrencesOf(sel.value, id) );// returns 3);  // 2
    for(var i=0;i<id.length;i++){
        
        if(id[i].value==sel.value && id[i].value!='' && counter>1){
            
            // if(document.getElementById('languageId').value == 'en'){
            //     alert( "Attention: You can't use the same verb more than once! ");
    
            // }else{
            //     alert( "Προσοχή: Δεν μπορείτε να χρησιμοποιήσετε το ίδιο ρήμα πάνω απο μια φορά!");
            // }
            errormsg.style.display = "block";
            // id[i].classList.remove('is-valid');
            // id[i].classList.add('is-invalid');
            // for(var j=i+2;j<15;j++){
            //     id[j].style.display = 'none';
            // }
            break;
        }else{
            errormsg.style.display = "none";
           
        }
        // else if(id[i].value!='') {
        //     id[i].classList.remove('is-invalid');
        //     id[i].classList.add('is-valid');
        //     for(var j=0;j<15;j++){
        //         id[j].style.display = 'block';
        //     }
        // }
    }
}