<div class="container">
    <h2>People! (Hover over Current/Registered to see More Info)</h2>
</div>


<div class ="container">
    <h2>Lecturers!</h2>
    <table>
        <tr style="background:white">
            <td class="sortable"><a href="?type=Lecturers&sort=getID&o=1">ID</a></td>
            <td class="sortable"><a href="?type=Lecturers&sort=getTitle&o=1">Title</td>
            <td class="sortable"><a href="?type=Lecturers&sort=getName&o=1">Forename</td>
            <td class="sortable"><a href="?type=Lecturers&sort=getSurname&o=1">Surname</td>
            <td class="sortable"><a href="?type=Lecturers&sort=getBirthday&o=1">Birthday</td>
            <td class="sortable"><a href="?type=Lecturers&sort=getWorkload&o=1">Workload</td>
            <td class="sortable"><a href="?type=Lecturers&sort=getCurrentCourses&o=1">Current</td>
            <td class="sortable"><a href="?type=Lecturers&sort=getPreviousCourses&o=1">Previous</td>
        </tr>
        <?php foreach ($lecturers as $lecturer) { ?>
            <tr>
                <td><?php echo $lecturer->getId();?></td>
                <td><?php echo $lecturer->getTitle();?></td>
                <td><?php echo $lecturer->getName();?></td>
                <td><?php echo $lecturer->getSurname();?></td>
                <td><?php echo $lecturer->getBirthday();?></td>
                <td><?php echo $lecturer->getWorkload();?></td>
                <td class="hoverable"><?php echo count($lecturer->getCurrentCourses());?>
                    <div class="hidebox">
                        <?php foreach ($lecturer->getCurrentCourses() as $course) {
                            echo $course->getName() . "<br>";
                        }
                        ?>
                    </div>
                </td>
                <td class="hoverable"><?php echo count($lecturer->getPreviousCourses());?>
                    <div class="hidebox">
                        <?php foreach ($lecturer->getPreviousCourses() as $course) {
                            echo $course->getName() . "<br>";
                        }
                        ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class ="container">
    <h2>Students!</h2>
    <table>
        <tr style="background:white">
            <td class="sortable"><a href="?type=Students&sort=getID&o=1">ID</a></td>
            <td class="sortable"><a href="?type=Students&sort=getName&o=1">Forename</td>
            <td class="sortable"><a href="?type=Students&sort=getSurname&o=1">Surname</td>
            <td class="sortable"><a href="?type=Students&sort=getBirthday&o=1">Birthday</td>
            <td class="sortable"><a href="?type=Students&sort=getWorkload&o=1">Workload</td>
            <td class="sortable"><a href="?type=Students&sort=getGPA&o=1">GPA</td>
            <td class="sortable"><a href="?type=Students&sort=getGPA&o=1">Status</td>
            <td class="sortable"><a href="?type=Students&sort=getCurrentCourses&o=1">Registered</td>
            <td class="sortable"><a href="?type=Students&sort=getPreviousCourses&o=1">Completed</td>

        </tr>
        <?php foreach ($students as $student) { ?>
            <tr>
                <td><?php echo $student->getId();?></td>
                <td><?php echo $student->getName();?></td>
                <td><?php echo $student->getSurname();?></td>
                <td><?php echo $student->getBirthday();?></td>
                <td><?php echo $student->getWorkload();?></td>
                <td><?php echo $student->getGPA();?></td>
                <td><?php echo $student->getStatus();?></td>
                <td class="hoverable"><?php echo count($student->getCurrentCourses());?>
                    <div class="hidebox">
                        <?php foreach ($student->getCurrentCourses() as $course) {
                            echo $course->getName() . "<br>";
                        }
                        ?>
                    </div>
                </td>
                <td class="hoverable"><?php echo count($student->getPreviousCourses());?>
                    <div class="hidebox">
                        <?php foreach ($student->getPreviousCourses() as $course) {
                            echo $course[0]->getName() . ": " . $course[1] .  "<br>";
                        }
                        ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>