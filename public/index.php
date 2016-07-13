<?php
require("../common/Db_connect.php");

$db_connection = new Db_connect();

?>

<!DOCTYPE html>
<html lang="en-US">
<html>
<head>
    <meta charset="utf-8">

    <title>Shadowchat</title>
    <!-- 
    <link href="css/bootstrap.min.css" rel="stylesheet">
    -->
    <style>
    header {
        background-color:#212227;
        color:#637074;
        text-align:center;
        padding:20px;
        height:100px;
    }
   section {
        background-color:#3C787E;
        margin:0 10% 0 10%;
        height:500px;
        padding:5px;
    }
    footer {
        background-color:#212227;
        color:#93A3B1;
        clear:both;
        text-align:center;
        height:100px;
        padding:20px;
    }
    body {
        background-color:#637074;
    }
    thead {
        padding:10px;
    }
    #title_date{
        width:12%;
    }
    #title_time{
        width:10%;
    }
    #title_user{
        width:15%;
    }
    #title_msg{
        width:63%;
    }
    div.chathead table {
        width:100%;
        border:1px solid black;
    }
    div.chatbody {
        color:#93A3B1; 
        height:80%;
        width:100%;
        overflow:auto; 
        table-layout:fixed;
    }
    div.chatbody td {
        padding-left:20px;
        text-align:left;
        vertical-align:top;
        word-wrap:break-word;
    }
    </style>
</head>

<body>
    <header>
    <!-- use chatroom id in the future -->
    <h1>Shadowchat</h1>    
    </header>

    <section>
    <div class="chathead">
    <table>
    <thead>
        <tr>
            <th id="title_data">Date</th>
            <th id="title_time">Time</th>
            <th id="title_user">User</th>
            <th id="title_msg">Message</th>
        </tr>
    </thead>
    </table>
    </div>

    <div class="chatbody">
    <table>
    <tbody>
        <tr>
            <?php $db_connection->showchat() ?>
        </tr>
    </tbody>
    </div>
    </table>
    </section>


    <footer>
    <p>This is footer</P>
    </footer>
</body>
</html>

