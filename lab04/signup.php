<?php include "top.html"; ?>

<form method="post" action="signup-submit.php">
    <fieldset>
        <legend>New User Sign Up</legend>
        <label><input name="name" type="text" size="16"><strong> Name:</strong></label>
        <br>
        <strong> Gender:</strong>
        <label><input type="radio" value="M" name="gender"> Male</label>
        <label><input type="radio" value="F" name="gender">Female</label>
        <br>
        <label><input name="age" size="6" maxlength="2"><strong>Age: </strong></label>
        <br>
        <label><input name="personality" type="text" maxlength="6" size="4"><strong> personality type:</strong></label>
        (<a href="bohh????">Don't know your type?</a>)<br>
        <label><strong> Favorite OS:</strong>
        <select name="os">
            <option value="linux">Linux</option>
            <option value="mac">Mac OS X</option>
            <option value="windows">Windows</option>
        </select>
        </label><br>
        <label>
            <strong>Seeking age: </strong>
            <input name="min_age" size="4" maxlength="2" placeholder="min"> to
            <input name="max_age" size="4" maxlength="2" placeholder="max">
        </label>
        <br>
        <input type="submit" value="Sign Up">
    </fieldset>
</form>


<?php include "bottom.html"?>