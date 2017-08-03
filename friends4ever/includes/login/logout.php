<?php
session_start();
if(session_destroy()){
	header("Location: http://theforge.me/friends4ever"); // Redirecting To Home Page
}
?>