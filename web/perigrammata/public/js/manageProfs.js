function RemovePartnerFromCourse(partnerId){
    
    courseID= document.getElementById('courseId').value;
    console.log(partnerId);
    var ajax_request = new XMLHttpRequest();
    

    ajax_request.open("POST", "RemovePartnerFromCourse?CourseId="+courseID+"&partnerId="+partnerId,true);

    ajax_request.send();
    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            location.reload();
        }
    }
}


function findMaxSectionNum(selected){
    courseID= document.getElementById('courseId').value;

    selection = selected.options[selected.selectedIndex].value;
    //console.log(selection);

    var ajax_request = new XMLHttpRequest();
    

    ajax_request.open("GET", "GetActivitiesMaxSectionNumber?CourseId="+courseID+"&activityid="+selection,true);

    ajax_request.send();
    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            var response = JSON.parse(ajax_request.responseText);
            console.log(response[0].maxNum);
            if(response[0].maxNum != null){ // if the activity has already some sections inserted
                var valueptr = parseInt(response[0].maxNum) + 1 ;
            }else { // here comes if the activity has no other sections inserted
                var valueptr = 1 ;
            }
            //set selectInput to the max value +1 of the section
            var select = document.getElementById('SectionNumber');
            while (select.options.length > 0) {
                select.remove(0);
            }
            var option = document.createElement('option');
            option.value = valueptr;
            option.text = valueptr;
            select.add(option);
        }
    }
}


//for inserting activities in a course
function AddActivity()
{
    var courseID= document.getElementById('courseId').value;
    var totalHours = document.getElementById('totalHours1').value;
    var activityId = document.getElementById('activity');
    var section = document.getElementById('SectionNumber').value;
    
    var activity = activityId.options[activityId.selectedIndex].value;
    
    //var section = Section.options[Section.selectedIndex].value;

    //console.log(section);
    var ajax_request = new XMLHttpRequest();
    

    ajax_request.open("GET", "AddActivityInCourse?&courseId="+courseID+"&hours="+totalHours+"&activityId="+activity+"&section="+section,true);

    ajax_request.send();
    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            window.location.href = "/perigrammata/ProfessorNewController/ManageActivities?CourseId="+courseID;
        }
    }

}


//submit partners on course
function SubmitPartner(){
    ptr = document.getElementById('partnersId').value; 
    courseID= document.getElementById('courseId').value;
    
    var radios = document.querySelectorAll('input[name="role"]');

    var userType;
    for (var i = 0; i < radios.length; i++) {
      if (radios[i].checked) {
        userType = radios[i].value;
        break;
      }
    }

    var ajax_request = new XMLHttpRequest();
    

    ajax_request.open("GET", "SubmitPartners?id="+ptr+"&courseId="+courseID+"&role="+userType,true);

    ajax_request.send();
    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            window.location.href = "/perigrammata/ProfessorNewController/Admin?CourseId="+courseID;
        }
    }
    
}


function activityRange(select){

    courseID= document.getElementById('courseId').value;

    var range = document.getElementById('customRange1');

    var ptr = document.getElementById('activities');

    activityid = ptr.options[ptr.selectedIndex].id;

    
    var ajax_request = new XMLHttpRequest();
    

    ajax_request.open("GET", "GetActivitiesMaxSectionNumber?CourseId="+courseID+"&activityid="+activityid,true);

    ajax_request.send();
    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            
            var response = JSON.parse(ajax_request.responseText);

            var i = 1 ;
            var select = document.getElementById('SectionNumForProf');
            while (select.options.length > 0) {
                select.remove(0);
            }
            var option = document.createElement('option');
            option.value ="";
            option.text = "Επιλέξτε Αριθμό Τμήματος";
            select.add(option);
            while(i <= response[0].maxNum){
                
                var option = document.createElement('option');
                option.id = i;
                option.value = i;
                option.text = i;
                select.add(option);
                i++;
            }
        }
    }

}
//for the range input on manage professor workload
function finalRange(){
    
    var range = document.getElementById('customRange1');
    courseID= document.getElementById('courseId').value;
    
    var sectionNum = document.getElementById('activities');

    activityid = sectionNum.options[sectionNum.selectedIndex].id;
    
    var type = document.getElementById('SectionNumForProf');

    secNum = type.options[type.selectedIndex].value;

    console.log(activityid);
    console.log(secNum);
    var ajax_request = new XMLHttpRequest();
    

    ajax_request.open("GET", "getHoursLeftForActivity?courseId="+courseID+"&activityId="+activityid+"&sectionNumber="+ secNum,true);

    ajax_request.send();
    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            
            var response = JSON.parse(ajax_request.responseText);

            var maxRange = response[0].total;
            range.removeAttribute('disabled');
            range.setAttribute("min", "0");
            range.setAttribute("max", maxRange);
            range.setAttribute("step", "0.5");
            range.setAttribute("value", "0");
        }
    }

}

//search bar
function loadProfessors(query ,enrolled){
    if(query.value.length >1)
    {
        var form_data = new FormData();
        
        var courseId = document.getElementById('courseId');

        form_data.append('query', query);

        var ajax_request = new XMLHttpRequest();
        
        ajax_request.open("GET", "get_users?query="+query.value+"&courseId="+courseId.value+"&enrolled="+enrolled,true);

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


                        html +='<a href="#" class="px-2 list-group-item list-group-item-action " onclick="addPartner(this);" id="'+response[count].id+'" value="'+response[count].firstname+ " " +response[count].lastname +'">'
                                        +newresponse + " " + newresponse2+'</a>';
                        
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


//search results
function addPartner(result){

    document.getElementById('search_result').innerHTML = '';    //remove the results
    edit = document.getElementById('partner_result');
    ptr = '<br><div class="px-2 list-group-item list-group-item-action">'+ result.getAttribute("value")+ '</div><br>';
    //ptr = '<br><ul>'+ result.getAttribute("value")+ '</ul>';
    ptr += '<input type="hidden" id="partnersId" value="'+result.id+'" />';
    edit.innerHTML = ptr;
    
}

function deleteMethod(methodnumber)
{
    courseid = document.getElementById('CourseId').value;
    console.log(courseid + methodnumber)

    var ajax_request = new XMLHttpRequest();
    

    ajax_request.open("GET", "DeleteMethod?&courseId="+courseid+"&methodNumber="+methodnumber,true);

    ajax_request.send();
    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            window.location.href = "/perigrammata/ProfessorNewController/EditLearningOutcomes?CourseId="+courseid;
        }
    }

}

//like the previous but resulting only the enrolled
function loadEnrolledPartners(){

}

//for editing activities in a course
function EditActivity()
{
    var courseID= document.getElementById('courseId').value;
    var totalHours = document.getElementById('totalHours2').value;
    var section = document.getElementById('editActivitySection').value;
    var activityId = document.getElementById('editActivity').value;

    
    var ajax_request = new XMLHttpRequest();
    

    ajax_request.open("GET", "EditActivityInCourse?&courseId="+courseID+"&hours="+totalHours+"&activityId="+activityId+"&sectionNumber="+section,true);

    ajax_request.send();
    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            window.location.href = "/perigrammata/ProfessorNewController/ManageActivities?CourseId="+courseID;
        }
    }

}

//for inserting hours in the start of the semester

function addActivityAndHours(){

    var partner = document.getElementById('partner');
    var activities = document.getElementById('activities');
    var hours = document.getElementById('totalHours').value;
    var courseID= document.getElementById('courseId').value;
    var secNum= document.getElementById('SectionNumForProf');

    var activity = activities.options[activities.selectedIndex].id;
    var sectionNum =  secNum.options[secNum.selectedIndex].value;
    var ajax_request = new XMLHttpRequest();
    

    ajax_request.open("GET", "AddProfessorWorkload?partnerid="+partner.value+"&courseId="+courseID+"&hours="+hours+"&activityId="+activity+"&sectionNum="+sectionNum,true);

    ajax_request.send();
    ajax_request.onreadystatechange = function()
    {

        if (ajax_request.readyState == 4 && ajax_request.status == 200)
        {   
            window.location.href = "/perigrammata/ProfessorNewController/ManageActivities?CourseId="+courseID;
        }
    }

}

//the modal for editing activities
function openModal(activityName,activityId,sectionNum)
{
    var activity = document.getElementById('editActivity');
    var actTitle = document.getElementById('selectedAct');
    var actSection = document.getElementById('editActivitySection');

    activity.setAttribute("value" ,activityId);
    actSection.setAttribute("value" , sectionNum);
    console.log(actSection.value);

    html = '<h4>Τύπος : '+activityName+'</h4>';
    html += '<h4>Τμήμα : '+actSection.value+'</h4><br>';
    actTitle.innerHTML = html;
}
