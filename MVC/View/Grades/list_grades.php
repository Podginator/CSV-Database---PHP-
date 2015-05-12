<div class="container">
    <h2>Grades! (Click on Course or Student Name to limit Grades)</h2>
</div>

<div class="container">
    <div class="filters">
        <h2>Filters</h2>
        <br/>
        <label>Select By Grade:</label>
        <select id="GetLetterGrade">
            <option>--</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
        </select>

        <label>Select By Person:</label>
        <select id="GetPersonGrade">
            <option>--</option>
            <?php foreach ($students as $student) { ?>
                <option value="<?php echo $student->getId(); ?>"><?php echo $student->getName();?> <?php echo $student->getSurname();?></option>
            <?php } ?>
        </select>

        <label>Select By Course:</label>
        <select id="GetCourseGrade">
            <option>--</option>
            <?php foreach ($courses as $course) { ?>
                <option value="<?php echo $course->getId() ?>"><?php echo $course->getName();?></option>
            <?php } ?>
        </select>

        <label><a href="<?php echo URL . 'Grades/' ?>" >  None</a></label>
    </div>

</div>

<div class ="container">
    <table>
        <tr style="background:white">
            <td class="sortable"><a href="?sort=courseName&o=1">Course Title</a></td>
            <td class="sortable"><a href="?sort=studentName&o=1">Student Name</a></td>
            <td class="sortable"><a href="?sort=surname&o=1">Surname</a></td>
            <td class="sortable"><a href="?sort=group&o=1">Group</a></td>
            <td class="sortable"><a href="?sort=year&o=1">Year</td>
            <td class="sortable"><a href="?sort=semester&o=1">Semester</td>
            <td class="sortable"><a href="?sort=grade&o=1">Grade</td>
        </tr>
        <?php foreach ($grades as $grade) { ?>
            <tr>
                <td><a href="<?php echo URL . 'Grades/GetCourseGrade/' .$grade['courseID'] ?>"><?php echo $grade["courseName"];?></a></td>
                <td><a href="<?php echo URL . 'Grades/GetPersonGrade/' .$grade['studentID'] ?>"><?php echo $grade["studentName"];?></td>
                <td><?php echo $grade["surname"];?></td>
                <td><?php echo $grade["group"];?></td>
                <td><?php echo $grade["year"];?></td>
                <td><?php echo $grade["semester"];?></td>
                <td><a href="<?php echo URL . 'Grades/GetLetterGrade/' .$grade['grade'] ?>"><?php echo $grade["grade"];?></td>
            </tr>
        <?php } ?>
    </table>
</div>

