<div class="container">
    <h2>Courses!</h2>
</div>

<div class ="container">
    <table>
        <tr style="background:white">
            <td class="sortable"><a href="?sort=getID&o=1">ID</a></td>
            <td class="sortable"><a href="?sort=getName&o=1">Title</a></td>
            <td class="sortable"><a href="?sort=getCredit&o=1">Credit</a></td>
            <td class="sortable"><a href="?sort=getGroupNums&o=1">No of Groups</td>
            <!--<td>Previously Taught</td>-->
        </tr>
        <?php foreach ($courses as $course) { ?>
            <tr>
                <td><?php echo $course->getID();?></td>
                <td><?php echo $course->getName();?></td>
                <td><?php echo $course->getCredit();?></td>
                <td><?php echo count($course->getGroups());?></td>

            </tr>
        <?php } ?>
    </table>
</div>
