<div class="container">
    <h2>Add Grades! - Upload CSV.</h2>
</div>


<div class="container">
    <h2>Add Grades</h2>


    <div class="formdiv">
        <form action="<?php echo URL; ?>AddGrades/AddRecord" method="post">
            <!-- Okay, after some deliberation I decided on something. Rather than Upload the file I'd put it in a hidden text area and
            use that to upload the necessary formatted csv to the server. Saves the need to validate file type on the backend, and, is useful.-->
            <label>Select CSV to upload: </label>
            <br/>
            <!--Chrome/IE10+/Safari?/Firefox Does not work in Mac.-->
            <!-- TODO: Add $_FILE Type restriction in php -->
            <input type="file" id="upload" accept=".csv"/>
            <textarea disabled id="filepreview" placeholder="Preview of CSV will go here"></textarea>
            <input type="submit" value="Submit"/>
            <textarea id="hiddenText" name="hide" style="display:none;"></textarea>
        </form>
    </div>

</div>