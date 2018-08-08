<?php header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Blog.io</title>
        <style type="text/css">
        	.error-div{
        		width: 60%;
			    margin: auto;
			    padding: 50px;
			    margin-top: 20px;
			    background: #f3f3f3;
			    border-radius: 20px;
        	}
        </style>
    </head>
    <body>
        <!--error 404-->
        <?php/* if (DEBUG): ?>
            <pre><?php print_r($e); ?></pre>
        <?php endif; */?>  
	<div class="d-flex justify-content-center align-items-center error-div" id="main">
	    <h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center">5xx</h1>
	    <div class="inline-block align-middle">
	    	<h2 class="font-weight-normal lead" id="desc">Server Error.</h2>
	    </div>
	</div>
    </body>
</html>
