<div class="p-5">

    <div class="container-fluid">
        <h2 class="text-center">
            <?php echo $title[0]["CourseTitle"] ." "."(". $title[0]["LessonCode"]. ")"?>
        </h2>
        <h2 class="text-center">
            <?php 
            if($categories!=null){
                $ptr = $categories[0]["CategoryId"];
                $stmt = $conn->prepare("SELECT CategoryName
                FROM perigrammata_db.assessment_categories
                WHERE Id = ?");
                $stmt->execute([$ptr]); 
                $categoryName = $stmt->fetchAll(); 
                echo $categoryName[0]["CategoryName"];
            ?>
        </h2> 
        <u style="font-weight: bold";>
            <?php
            echo "Υποκατηγορίες που έχουν οριστεί:";
            echo '</u>';
            echo '<br>';
            echo '<i>';
            foreach($categories as $Id => $row){
            $subexist=0;
                if ($row["SubcategoryId1"]!= 0)
                {
                    $subexist++;
                    $ptr = $categories[0]["SubcategoryId1"];
                    $stmt = $conn->prepare("SELECT SubcategoryName
                                            FROM perigrammata_db.assessment_subcategories
                                            WHERE Id = ?");
                    $stmt->execute([$ptr]); 
                    $categoryName = $stmt->fetchAll();
                    echo $categoryName[0]["SubcategoryName"]; 
                    echo '<br>';
                } 
                if ($row["SubcategoryId2"]!= 0)
                {
                    $subexist++;
                    $ptr = $categories[0]["SubcategoryId2"];
                    $stmt = $conn->prepare("SELECT SubcategoryName
                                            FROM perigrammata_db.assessment_subcategories
                                            WHERE Id = ?");
                    $stmt->execute([$ptr]); 
                    $categoryName = $stmt->fetchAll();
                    echo $categoryName[0]["SubcategoryName"]; 
                    echo '<br>';
                } 
                if ($row["SubcategoryId3"]!= 0)
                {
                    $subexist++;
                    $ptr = $categories[0]["SubcategoryId3"];
                    $stmt = $conn->prepare("SELECT SubcategoryName
                                            FROM perigrammata_db.assessment_subcategories
                                            WHERE Id = ?");
                    $stmt->execute([$ptr]); 
                    $categoryName = $stmt->fetchAll();
                    echo $categoryName[0]["SubcategoryName"];  
                    echo '<br>';
                } 
                if ($row["SubcategoryId4"]!= 0)
                {
                    $subexist++;
                    $ptr = $categories[0]["SubcategoryId4"];
                    $stmt = $conn->prepare("SELECT SubcategoryName
                                            FROM perigrammata_db.assessment_subcategories
                                            WHERE Id = ?");
                    $stmt->execute([$ptr]); 
                    $categoryName = $stmt->fetchAll();
                    echo $categoryName[0]["SubcategoryName"];  
                    echo '<br>';
                } 
                if ($subexist==0)       //the case where an assessment has no subcategories
                {
                    echo "No subcategories inserted. General grade allowed."; 
                    echo '<br>';
                } 
                echo '</i>';
                echo '<br>';
                echo '<u style="font-weight:bold">';
                echo "Ποσοστό επί του βαθμού: ";
                echo '</u>';
                echo '</br>';
                echo $row['Percentage'] . '%';
                echo '<br>';
                echo '<br>';
            }
            ?>

            <?php 
            $cat =$categories[0]["CategoryId"];
            $num = 1;
            
            ?>  
            
                <table class="mmtable">
                <thead class="mmthead">
                    <tr>
                    <th>Αριθμός </th>
                    <th>Επιμέρους ποσοστό %</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($allAssessment as $Id => $row){
                            echo '<tr>';
                            echo '<td>';
                            echo $row['AssessmentNumber'];
                            echo '</td>';
                            echo '<td>';
                            echo '<input type="text" id="percentage'.$row['AssessmentNumber'].'" value="'.$row['Percentage'].'" onchange="changeOldPercentage('.$row['CourseId'].','.$row['AssessmentMethod'].','.$row['AssessmentId'].','.$row['AssessmentNumber']. ')" >';
                            echo '</td>';
                            echo '<td>';
                            echo '<button class="rmbutton" id="remove'.$num.'" onclick="RemoveRow('. $row["CourseId"] .','. $row["AssessmentMethod"] .',' . $row["AssessmentId"].','.$row["AssessmentNumber"] . ')">Αφαίρεση</button>';
                            echo '</td>';
                            echo '</tr>';
                            $num++;
                        }
                    ?>
                </tbody>
                </table>
                <input type="hidden" id="number" name="number" value="<?php echo $num;?>">
                <input type="hidden" id="language" name="language" value="<?php echo $_SESSION['lang'];?>">
                <button class="mmbutton" onclick="addRow(<?php echo $courseID .','. $method_number .',' . $category;?>)">Προσθήκη</button>    
    </div>
</div>
<?php 
            
            }else{
                 echo '<h4>' . "Δεν έχει οριστεί η υποκατηγορία" . '</h4>';
        }

?>