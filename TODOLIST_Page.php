<!DOCTYPE html>
<html>

<!--==================================================================
//
// Web site: To Do List Web Site
// Web page: Main Page
// Description:
//   web page that shows the data in a mysql database. Also can adds and delete from the database
// 
//=================================================================-->

<head>
  
  <title>ToDo List</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="author" content="Akil Clark"/>
  <meta name="description" content="To Do List Page"/>
  <meta http-equiv="Expires" content="-1">
  <!-- Fonts -->
  <link rel="stylesheet" type="text/css" href="ToDoStyles.css">
  <link href='//fonts.googleapis.com/css?family=Carter One' rel='stylesheet'>
  <link href='//fonts.googleapis.com/css?family=EB Garamond' rel='stylesheet'>
  <link href='//fonts.googleapis.com/css?family=Jacques Francois Shadow' rel='stylesheet'>
  <link href='//fonts.googleapis.com/css?family=Ubuntu Mono' rel='stylesheet'>
  <link href='//fonts.googleapis.com/css?family=VT323' rel='stylesheet'>

  </head>
 
<body>

  <!-- Get data -->
  <?php
    
    // Set connection parameters and create connection
    $host = "127.0.0.1";
    $user = "root";
    $password = "mysql";
    $database = "TODOLIST";
    $cxn = mysqli_connect($host, $user, $password, $database);
                
    // Test operation
    if($_POST["rbOperation"] == "Add")
    {
      
      // Create and submit update query
      $sql = "insert into List (ToDo ) values ('" . $_POST["tName"] . "');";
      $result = mysqli_query($cxn, $sql);
            
      // Test if query failed
      if($result == false)
      {
        $message = "<h3>ADD operation failed!</h3>" . 
          "<h4>ADD command error: " . $sql . "</h4>" .
          "<h4>SQL Error: " . mysqli_error($cxn) . "</h4>";
      }
      else
      {
        $message = "<h3>ADD operation succeeded!</h3>";
      }

    }
    else if($_POST["rbOperation"] == "Delete")
    {
      
      // Create and submit update query
      $sql = "delete from List where ListID = '" . $_POST["tID"] . "';";
      $result = mysqli_query($cxn, $sql);
            
      // Test if query failed
      if($result == false)
      {
        $message = "<h3>DELETE operation failed!</h3>" .
          "<h4>DELETE command error: " . $sql . "</h4>" .
          "<h4>SQL Error: " . mysqli_error($cxn) . "</h4>";
      }
      else
      {
        $message = "<h3>DELETE operation succeeded!</h3>";
      }

    }
    else
    {
      $message = "<h3>NO operation specified.</h3>";
    }

    // Create and submit SQL statement
    $sql = "select ListID, ToDo from List;";
    $result = mysqli_query($cxn, $sql);

  ?>

  <!-- Headers -->
  <h1>To Do List Main Page</h1>
  <hr>

  <!-- Table -->
  
  <table style="border:2px; width:100%">
    
    <!-- Column specs -->
    <colgroup>
      <col width="16%">
      <col width="16%">
    </colgroup>
    
    <!-- Column headers -->
    <thead>
      <tr>
        <td>
          <b>ID</b>
        </td>
        <td>
          <b>To Do</b>
        </td>
      </tr>
    </thead>
    
    <!-- Rows and columns -->
    <tbody>

      <!-- Show data -->
      <?php
            
        // Test if command failed
        if($result == false)
        {
          echo "<tr><td colspan='3'>SQL error: no data available!</td></tr>";
        }
        else 
        {
        	if($_POST["rbOperation"] == "Show")
        	{


				echo "<tr>";
				while($row = mysqli_fetch_row($result))
				{
        	    	echo "<td>$row[0]</td>";
        	    	echo "<td>$row[1]</td>";
        	    	echo "</tr>";
        	    }

        	    $message = "<h3>Show operation succeeded!</h3>";
        	}
    	}

      ?>
      
    <tbody>
  
  </table>

  <!-- Form -->
  <h2>To Do List Form</h2>

  <form 
    method="post" 
    enctype="application/x-www-form-urlencoded"
    action="http://127.0.1/TODOLIST_Page.php" 
    >
    
    <!-- Add operation -->
    <fieldset>
      <legend>Add Tasks</legend>
      <input type="radio" name="rbOperation" value="Add">
      <span>Add</span>      
      <br><br>
      
      <!-- Task name -->
      <label>Task:</label>
      <input type="text" name="tName" class="in">

    </fieldset>

    <!-- Delete operation -->
    <fieldset>
      <legend>Delete Tasks</legend>
      <input type="radio" name="rbOperation" value="Delete">
      <span>Delete</span>      
      <br><br>
          
      <!-- List ID -->
      <label>Task ID:</label>
      <input type="text" name="tID" class="in">
      
    </fieldset>

    <fieldset>
      <legend>Show Tasks</legend>
      <input type="radio" name="rbOperation" value="Show">
      <span>Show To Do List</span>      
      <br><br>

    </fieldset>

    <br>
    <span id="buttons"><input type="submit" value="Submit" class="btn">
    <input type="reset" value="Reset" class="btn"></span>

  </form>

  <!-- Show message -->
  <?php
    echo $message;
  ?>
  
  <hr>
  
</body>
 
</html>
