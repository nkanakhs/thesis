<div class="py-5">
        <div class="card card-cascade narrower container px-0 ">
                    <div class="view view-cascade gradient-card-header myblue1 z-depth-2 text-center  narrower py-4 px-1  mb-3  rounded ">
                        <h4 class="mycourses text-white font-italic "><?php echo $title[0]["CourseTitle"] . "\t" . $title[0]["LessonCode"]?> </h4>
                    </div>
    <div class="py-5 px-5">
      <form  class="customSelect" method="POST" action="<?php echo URL . "ProfessorController/ProfChoice?CourseId=" .$courseID ; ?>">
        <div class="select  ">
        <select  class='browser-default custom-select ' name ="choice" required>
          <option value="" disabled selected hidden ><?php echo t_action;?></option>
          <option value="1" ><?php echo t_action1;?></option>
          <option value="2"><?php echo t_action2;?></option>
          <option value="3" ><?php echo t_action3;?></option>
          <option value="4" ><?php echo t_action4;?></option>
        </select>
        </div>
            <div class="text-center py-5">
            <div id="subBtn">
                <button type="submit" name="submit" class="subBtn"><?php echo t_next;?></button>
            </div>
            </div>  
      </form>
      </div>
</div>
  </div>
</div>