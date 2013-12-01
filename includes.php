<?php
/*
 * 2011 Oct 28
 * CSCC40 - Tutorial Scheduling System
 *
 * This is a wrapper file which is supposed to include all library files used
 * in our system and the configuration file.
 *
 * @author Kobe Sun
 *
 */

# include general configuration
include_once("config.php");	// Config file has to be included at the top

# include MYSQL-PHP Class
include_once("includes/Database.singleton.php");

# include PHP Session Class
include_once("includes/Session.singleton.php");

# include PHP Cookie Class
include_once("includes/Cookie.singleton.php");

# include all classes files
include_once("includes/User.php");

//tom update start
# include validate files
include_once("account/validate.php");
//tom update end

# include instantiation step
include_once("common.php");	// This has to be done after importing mysql class

?>

