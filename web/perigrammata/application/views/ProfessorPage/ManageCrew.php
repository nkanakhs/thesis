
<input type="hidden" id="courseId" value="<?php echo $courseID;?>" />
<input type="hidden" id="language" value="<?php echo $_SESSION['lang'];?>" />
<section class="container py-5">
    <div id="create_course">   
        <form method="POST" action="<?php echo URL . "ProfessorController/SubmitCrewMembers?courseId=" . $courseID ;?>">
            <h4 class="text-center"> <?php echo p_managepartner;?> </br> </h4>
            <input type="hidden" id="courseID" value="<?php echo $courseID ?>">
            <div class="table-wrapper table-responsive py-2" >
                <table class="table table-bordered table-hover mt-0">
                    <input type="hidden" name='CourseId' value="<?php echo $Course['Id'];?>"/>  
                    <tr>   
                        <th class="font-weight-bold myblue1 text-white" width="40%">
                            <?php echo p_professors;?> 
                        </th>
                        <td colspan="4" width="60%">
                            <?php
                                echo "<select class='browser-default custom-select' name='professors' title='professors'>";
                                $cnt=0;
                                foreach ($professorsId as $Id => $row ) {
                                    echo "<option value=" . var_dump($row) .  ">" . $row. "</option>";
                                    $cnt++;
                                }
                                echo "</select>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold myblue1 text-white">
                            <?php echo p_addprofessors;?> 
                        </th>
                        <td colspan="3" id="js-profs">
                            <?php
                                echo '<input type="hidden" id="counter" value="'.$cnt.'" >';
                                echo "<select class='browser-default custom-select' name='Professor' id='js-Professor' title='Professor' onchange='addProfessors2(".($cnt -1).")'>";
                                echo "<option value=''>".p_chooseProf ."</option>";
                                foreach ($professor as $Id => $row ) {
                                    $disabled = "";
                                    if( key_exists( $Id, $professorsId ) )
                                    {
                                        $disabled = "disabled";
                                    }
                                    echo "<option value='" . $Id. "' ".$disabled.">" .$row ."</option>";
                                }
                                echo "</select>";
                            ?>
                                <?php
                                    $k=0;
                                    foreach ($professorsId as $ProfessorId => $name ) {
                                        $selected_index = array_search($ProfessorId, array_keys($professor))+1;
                                        echo '<div class="text-center" id="js-professors'.$k.'">';
                                        echo '<input type="text" name="ProfessorName[]" id="pname_'.$selected_index.'" value="'.$name.'" title="ProfessorName[]" placeholder="selected prof" style="width:200px;" readonly/>';
                                        echo '<input type="hidden" name="ProfessorId[]" id="pid_'.$selected_index.'" value="'.$ProfessorId.'" />';
                                        echo '<button type="button" name="remove" id="pbutton_'.$selected_index.'" class="rmbutton"  onclick="removeProfessors2('.$selected_index.','.$k.')">'.p_removebtn.'</button>';
                                        echo '</div>';
                                        $k++;
                                    }
                                    
                                ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="font-weight-bold myblue1 text-white">
                            <?php echo p_addpartners;?> 
                        </th>
                        <td colspan="3">
                            <input type="text" name="search_box" class="form-control form-control-lg" style="width:100%; outline: thin grey solid;" placeholder="<?php echo p_choosePartner;?>"  onkeyup="load_data(this);"></input>
                            <span id="search_result"></span>
                            <div class="text-center" id="js-partners">
                                <?php
                                    $k=0;
                                    foreach ($partners as $partner => $name ) {
                                        echo '<div class="text-center">';
                                        echo '<input type="text" name="partnersName[]" id="pname_'.$partner.'" value="'.$name.'" title="PartnerName[]" placeholder="selected partner" style="width:200px;" readonly/>';
                                        echo '<input type="hidden" name="partnersId[]" id="p_'.$partner.'" value="'.$partner.'" />';
                                        echo '<button type="button" name="remove" id="pbutton_'.$partner.'" onclick="removePartner('.$partner.')" class="rmbutton">'.p_removebtn.'</button>';
                                        echo '</div>';
                                    }
                                    
                                ?></div>
                        </td>
                    </tr>
                    <?php
                        $db_username = 'perigrammata_db';
                        $db_password = '@ad1p_c0urses_29_01_2020';
                        $conn = new PDO('mysql:host=db;dbname=perigrammata_db;charset=utf8;port=3306', 
                        $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8"));
                        $j=1;     
                       foreach ($methodNumber as $Id => $methodNum){ 
                        ?>
                        <tr>
                            <th class="font-weight-bold myblue1 text-white">
                                <?php 
                                    echo $methodNum['method_number'] ." ".t_methodnumber;
                                ?> 
                            <br>
                            <small>
                            <i><?php echo t_partnerinfo; ?></i>
                            </small>
                            </th>
                            <td colspan="3">
                                <?php        
                                    foreach ($methods as $Id2 => $method){
                                        if($method['method_number']== $methodNum['method_number']){
                                            //$stmt = $conn->prepare("SELECT CategoryName
                                              //                  FROM assessment_categories  
                                               //                 WHERE Id = ? ");    
                                            //$stmt->execute([$method['CategoryId']]); 
                                            //$categoryname = $stmt->fetchAll();

                                            echo '<div class="text-center">';
                                            //echo '<span style="font-weight: bold; font-family:serif; font-size: 110%">' . $categoryname[0]["CategoryName"] . '</span>';
                                            
                                            $ptr = 'assessment'.$method['CategoryId'];
                                            echo '<p style="font-weight: bold; font-family:serif; font-size: 110%">'. constant($ptr). '</p>';
                                            
                                            echo '</div>';
                                            echo '</br>';
                                            echo '</br>';

                                            if($method['SubcategoryId1']!=0){

                                                echo '<div class="text-center">';
                                                
                                                $ptr1 = 'subcategory'.$method['SubcategoryId1'];
                                                echo '<p style="font-weight: bold; font-family:Times; font-size: 100%">'. constant($ptr1). '</p>';
                                               
                                                echo '</div>';
                                                echo "<select class='browser-default custom-select' name='Partner_' id='select_".$Id.$method['CategoryId'].$method['SubcategoryId1']."' title='Parnter' onclick='loadPartners($Id,$method[CategoryId],$method[SubcategoryId1]);' onchange='insertPartner($Id,$method[CategoryId],$method[SubcategoryId1]);' >";
                                                echo '<option>'.p_choosePartner.'</option>';
                                                echo "</select>";
                                                echo "<div class='text-center' id='js-partners".$Id.$method['CategoryId'].$method['SubcategoryId1']."' >";
                                                $stmt = $conn->prepare("SELECT partnerId , d.firstname, d.lastname
                                                                FROM partner_jurisdiction
                                                                inner join user as d on d.Id= partnerId
                                                                WHERE courseId = ? and method_number =? and assessmentId=? and subcategoryId=?  ");    
                                                $stmt->execute([$courseID, $methodNum['method_number'] , $method['CategoryId'] ,$method['SubcategoryId1'] ]); 
                                                $partnersSub1 = $stmt->fetchAll();
                                                //var_dump($partnersSub1);
                                                foreach ($partnersSub1 as $partner => $name ) {
                                                    echo "<div class='text-center'>";
                                                    echo '<input type="text" name="partnersName[]" id="partnername_'.$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId1'].'" value="'.$name["firstname"] ." ". $name["lastname"] .'" title="PartnerName[]" placeholder="selected partner" style="width:200px;" readonly/>';
                                                    echo '<input type="hidden" name="partnersId[]" id="partnerid_'.$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId1'].'" value="'.$partner.'" />';
                                                    echo "<button type='button' name='remove' id='partnerbutton_".$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId1']."' onclick='removePartnerSpecific($name[partnerId],$Id,$method[CategoryId],$method[SubcategoryId1])' class='rmbutton'>".p_removebtn."</button>";
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                                echo '</br>';
                                            }
                                            if($method['SubcategoryId2']!=0){
                                                echo '<div class="text-center">';
                                                
                                                $ptr2 = 'subcategory'.$method['SubcategoryId2'];
                                                echo '<p style="font-weight: bold; font-family:Times; font-size: 100%">'. constant($ptr2). '</p>';
                                                echo '</div>';
                                                echo "<select class='browser-default custom-select' name='Partner_' id='select_".$Id.$method['CategoryId'].$method['SubcategoryId2']."' title='Parnter' onclick='loadPartners($Id,$method[CategoryId],$method[SubcategoryId2]);' onchange='insertPartner($Id,$method[CategoryId],$method[SubcategoryId2]);' >";
                                                echo '<option>'.p_choosePartner.'</option>';
                                                echo "</select>";
                                                echo "<div class='text-center' id='js-partners".$Id.$method['CategoryId'].$method['SubcategoryId2']."' >";
                                                $stmt = $conn->prepare("SELECT partnerId , d.firstname, d.lastname
                                                            FROM partner_jurisdiction
                                                            inner join user as d on d.Id= partnerId
                                                            WHERE courseId = ? and method_number =? and assessmentId=? and subcategoryId=?  ");    
                                                $stmt->execute([$courseID, $methodNum['method_number'] , $method['CategoryId'] ,$method['SubcategoryId2'] ]); 
                                                $partnersSub2 = $stmt->fetchAll();
                                                //var_dump($partnersSub2);
                                                foreach ($partnersSub2 as $partner => $name ) {
                                                    echo "<div class='text-center'>";
                                                    echo '<input type="text" name="partnersName[]" id="partnername_'.$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId2'].'" value="'.$name["firstname"] ." ". $name["lastname"] .'" title="PartnerName[]" placeholder="selected partner" style="width:200px;" readonly/>';
                                                    echo '<input type="hidden" name="partnersId[]" id="partnerid_'.$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId2'].'" value="'.$partner.'" />';
                                                    echo "<button type='button' name='remove' id='partnerbutton_".$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId2']."' onclick='removePartnerSpecific($name[partnerId],$Id,$method[CategoryId],$method[SubcategoryId2])' class='rmbutton'>".p_removebtn."</button>";
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                                echo '</br>';
                                            }
                                            if($method['SubcategoryId3']!=0){

                                                echo '<div class="text-center">';
                                                $ptr3 = 'subcategory'.$method['SubcategoryId3'];
                                                echo '<p style="font-weight: bold; font-family:Times; font-size: 100%">'. constant($ptr3). '</p>';
                                                echo '</div>';
                                                echo "<select class='browser-default custom-select' name='Partner_' id='select_".$Id.$method['CategoryId'].$method['SubcategoryId3']."' title='Parnter' onclick='loadPartners($Id,$method[CategoryId],$method[SubcategoryId3]);' onchange='insertPartner($Id,$method[CategoryId],$method[SubcategoryId3]);' >";
                                                echo '<option>'.p_choosePartner.'</option>';
                                                echo "</select>";
                                                echo "<div class='text-center' id='js-partners".$Id.$method['CategoryId'].$method['SubcategoryId3']."' >";
                                                $stmt = $conn->prepare("SELECT partnerId , d.firstname, d.lastname
                                                                FROM partner_jurisdiction
                                                                inner join user as d on d.Id= partnerId
                                                                WHERE courseId = ? and method_number =? and assessmentId=? and subcategoryId=?  ");    
                                                $stmt->execute([$courseID, $methodNum['method_number'] , $method['CategoryId'] ,$method['SubcategoryId3'] ]); 
                                                $partnersSub3 = $stmt->fetchAll();
                                                //var_dump($partnersSub1);
                                                foreach ($partnersSub3 as $partner => $name ) {
                                                    echo "<div class='text-center'>";
                                                    echo '<input type="text" name="partnersName[]" id="partnername_'.$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId3'].'" value="'.$name["firstname"] ." ". $name["lastname"] .'" title="PartnerName[]" placeholder="selected partner" style="width:200px;" readonly/>';
                                                    echo '<input type="hidden" name="partnersId[]" id="partnerid_'.$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId3'].'" value="'.$partner.'" />';
                                                    echo "<button type='button' name='remove' id='partnerbutton_".$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId3']."' onclick='removePartnerSpecific($name[partnerId],$Id,$method[CategoryId],$method[SubcategoryId3])' class='rmbutton'>".p_removebtn."</button>";
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                                echo '</br>';
                                            }
                                            if($method['SubcategoryId4']!=0){
                                                echo '<div class="text-center">';
                                                $ptr4 = 'subcategory'.$method['SubcategoryId4'];
                                                echo '<p style="font-weight: bold; font-family:Times; font-size: 100%">'. constant($ptr4). '</p>';
                                                echo '</div>';
                                                echo "<select class='browser-default custom-select' name='Partner_' id='select_".$Id.$method['CategoryId'].$method['SubcategoryId4']."' title='Parnter' onclick='loadPartners($Id,$method[CategoryId],$method[SubcategoryId4]);' onchange='insertPartner($Id,$method[CategoryId],$method[SubcategoryId4]);' >";
                                                echo '<option>'.p_choosePartner.'</option>';
                                                echo "</select>";
                                                echo "<div class='text-center' id='js-partners".$Id.$method['CategoryId'].$method['SubcategoryId4']."' >";
                                                $stmt = $conn->prepare("SELECT partnerId , d.firstname, d.lastname
                                                                FROM partner_jurisdiction
                                                                inner join user as d on d.Id= partnerId
                                                                WHERE courseId = ? and method_number =? and assessmentId=? and subcategoryId=?  ");    
                                                $stmt->execute([$courseID, $methodNum['method_number'] , $method['CategoryId'] ,$method['SubcategoryId4'] ]); 
                                                $partnersSub4 = $stmt->fetchAll();
                                                //var_dump($partnersSub1);
                                                foreach ($partnersSub4 as $partner => $name ) {
                                                    echo "<div class='text-center'>";
                                                    echo '<input type="text" name="partnersName[]" id="partnername_'.$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId4'].'" value="'.$name["firstname"] ." ". $name["lastname"] .'" title="PartnerName[]" placeholder="selected partner" style="width:200px;" readonly/>';
                                                    echo '<input type="hidden" name="partnersId[]" id="partnerid_'.$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId4'].'" value="'.$partner.'" />';
                                                    echo "<button type='button' name='remove' id='partnerbutton_".$name["partnerId"].$Id.$method['CategoryId'].$method['SubcategoryId4']."' onclick='removePartnerSpecific($name[partnerId],$Id,$method[CategoryId],$method[SubcategoryId4])' class='rmbutton'>".p_removebtn."</button>";
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                                echo '</br>';
                                            }
                                            
                                            if($method['SubcategoryId1']==0 && $method['SubcategoryId2']==0 && $method['SubcategoryId3']==0 && $method['SubcategoryId4']==0){
                                                
                                                echo '<div class="text-center">';
                                                echo '<p style="font-weight: bold; font-family:Times; font-size: 100%">' .s_general. '</p>';
                                                echo '</div>';
                                                echo "<select class='browser-default custom-select' name='Partner_' id='select_".$Id.$method['CategoryId'].'33'."' title='Parnter' onclick='loadPartners($Id,$method[CategoryId],33);' onchange='insertPartner($Id,$method[CategoryId],33);' >";
                                                echo '<option>'.p_choosePartner.'</option>';
                                                echo "</select>";
                                                echo "<div class='text-center' id='js-partners".$Id.$method['CategoryId'].'33'."' >";
                                                $stmt = $conn->prepare("SELECT partnerId , d.firstname, d.lastname
                                                                FROM partner_jurisdiction
                                                                inner join user as d on d.Id= partnerId
                                                                WHERE courseId = ? and method_number =? and assessmentId=? and subcategoryId=?  ");    
                                                $stmt->execute([$courseID, $methodNum['method_number'] , $method['CategoryId'] , 33 ]); 
                                                $partnersGeneral = $stmt->fetchAll();
                                                //var_dump($partnersSub1);
                                                foreach ($partnersGeneral as $partner => $name ) {
                                                    echo "<div class='text-center'>";
                                                    echo '<input type="text" name="partnersName[]" id="partnername_'.$name["partnerId"].$Id.$method['CategoryId'].'33'.'" value="'.$name["firstname"] ." ". $name["lastname"] .'" title="PartnerName[]" placeholder="selected partner" style="width:200px;" readonly/>';
                                                    echo '<input type="hidden" name="partnersId[]" id="partnerid_'.$name["partnerId"].$Id.$method['CategoryId'].'33'.'" value="'.$partner.'" />';
                                                    echo "<button type='button' name='remove' id='partnerbutton_".$name["partnerId"].$Id.$method['CategoryId'].'33'."' onclick='removePartnerSpecific($name[partnerId],$Id,$method[CategoryId],33)' class='rmbutton'>".p_removebtn."</button>";
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                                echo '</br>';
                                            }
                                            $j = $j+4;
                                            echo '<br>';
                                            echo '</br>';
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                       }
                        ?>
                </table>
            </div>
            

            <div class="text-center">
                <button type="submit" name="finish_creation" class="mmbutton"><?php echo t_submit;?></button>
            </div>
            </br>
        </form>
    </div>
</section>