/*
    ORIGINAL PUC E-LEARNING SYSTEM DATABASE SQL SCRIPT.
    BY : EFFAH GODWIN GOODMAN - PUC/150413
       : IJEOMA ONYESOM PEACE - PUC/
    DATE : SUNDAY DECEMBER 23, 2018
    MYSQL DATABASE
*/

/*---- Create Database ------*/
CREATE DATABASE `elearning`;
    USE `elearning`;

/*----  Create Faculty table*/
CREATE TABLE `faculty`(
    `facID` varchar(50) not null primary key,
    `facultyName` varchar(100) not null,
    `doe` datetime not null
)engine = InnoDB;

/*--- Create Department table -----*/
CREATE TABLE `department`(
    `depID` varchar(50) not null PRIMARY KEY,
    `facID` varchar(50) not null,
    `departmentName` varchar(100) not null,
    `doe` datetime
)engine = InnoDB;

/*--- Create Courses table -----*/
CREATE TABLE `courses`(
    `cID` varchar(50) not null PRIMARY KEY,
    `depID` varchar(50) not  null,
    `courseName` varchar(255) not null,
    `level` int(10) not null,
    `semester` int(10) not null,
    `doe` datetime
)engine = InnoDB;

/*--- Create lecturer table -----*/
CREATE TABLE `lecturer`(
    `lecID` varchar(50) not null PRIMARY KEY,
    `facID` varchar(50) not null,
    `depID` varchar(50) not null,
    `firstName` varchar(50) not null,
    `lastName` varchar(50) not null,
    `otherName` varchar(50) null,
    `email` varchar(50) not null,
    `phone` varchar(15) not null,
    `doe` datetime
)engine = InnoDB;

/*--- Create studnet table -----*/
CREATE TABLE `student`(
    `studentID` varchar(50) not null primary key,
    `depID` varchar(50) not null,
    `firstName` varchar(50) not null,
    `lastName` varchar(50) not null,
    `otherName` varchar(50) null,
    `email` varchar(50) not null,
    `phone` varchar(15) not null,
    `school` varchar(20) not null,
    `doe` datetime
)engine = InnoDB;

/*--- Create user login table -----*/
CREATE TABLE `users`(
    `userID` varchar(50) not null,
    `email` varchar(50) not null,
    `password` varchar(50) not null,
    `access` varchar(50) not null,
    `flogin` varchar(50) not null,
    `doe` datetime
)engine = InnoDB;

/*------ create course management table -----*/
CREATE TABLE `cmanagement`(
    `assignID` int(255) not null primary key auto_increment,
    `cID` varchar(50) not null,
    `lecID` varchar(50) not null,
    `doe` datetime
)engine = InnoDB;


/*----  create course outline table --------*/
CREATE TABLE `outline`(
    `id` int(255) not null primary key auto_increment,
    `cID` varchar(50) not null,
    `lecID` varchar(50) not null,
    `outline` varchar(255) not null,
    `doe` datetime not null,
    `dor` timestamp
)engine = InnoDB;

CREATE TABLE `lecture`(
    `id` int(255) not null auto_increment primary key,
    `cID` varchar(50) not null,
    `lecID` varchar(255) not null,
    `lecNum` int(20) not null,
    `lecTitle` longtext not null,
    `doe` datetime not null,
    `dor` timestamp
)engine = InnoDB;

/*---- create course document table -------*/
CREATE TABLE `cdocument`(
    `id` int(255) not null primary key auto_increment,
    `cID` varchar(50) not null,
    `lecID` varchar(50) not null,
    `lecture` int(100) not null,
    `lectitle` varchar(255) not null,
    `docName` varchar(255) not null,
    `doe` datetime not null,
    `dor` timestamp
)engine = InnoDB;


/*---- create course media table -------*/
CREATE TABLE `cmedia`(
    `id` int(255) not null primary key auto_increment,
    `cID` varchar(50) not null,
    `lecID` varchar(50) not null,
    `lecture` int(100) not null,
    `mediatype` int(5) not null, /* 1=video 2= audio*/
    `mediaName` varchar(255) not null,
    `path` varchar(255) not null,
    `doe` datetime not null,
    `dor` timestamp
)engine = InnoDB;

/*---- create required reading table -------*/
CREATE TABLE `reqreading`(
    `id` int(255) not null primary key auto_increment,
    `cID` varchar(50) not null,
    `lecID` varchar(50) not null,
    `readType` varchar(30) not null,
    `content` longtext not null,
    `doe` datetime not null,
    `dor` timestamp
)engine = InnoDB;


/*-------  create test table ------------------*/
CREATE TABLE `test`(
    `id` int(255) not null primary key auto_increment,
    `cID` varchar(50) not null,
    `testID` varchar(20) not null,
    `lecture` int(20) not null,
    `passMark` int(100) not null,
    `duration` int(100) not null,
    `status` varchar(20) not null,
    `doe` datetime
)engine = InnoDB;


create table `objtest`(
    `qid` int(255) not null primary key auto_increment,
    `testID` varchar(20) not null,
    `question` longtext not null,
    `option1` varchar(255) not null,
    `option2` varchar(255) not null,
    `option3` varchar(255) not null,
    `option4` varchar(255) not null,
    `answer` int(10) not null,
    `doe` datetime not null
)engine = InnoDB;

create table `objans`(
    `id` int(255) not null primary key auto_increment,
    `testID` varchar(20) not null,
    `qid` int(20) not null,
    `studentID` varchar(50) not null,
    `answer` int(10) not null,
    `right_ans` int(10) not null,
    `score` int(5) not null,
    `doe` datetime not null
)engine = InnoDB;

create table `generalReport`(
    `id` int(255) not null primary key auto_increment,
    `studentID` varchar(50) not null,
    `cID` varchar(100) not null,
    `testID` varchar(50) not null,
    `totalScore` int(100) not null,
    `doe` timestamp
)engine = InnoDB;


create table `messages`(
    `mid` int(255) not null primary key auto_increment,
    `sender` varchar(100) not null,
    `recipient` varchar(100) not null,
    `heading` longtext not null,
    `text` longtext not null,
    `date` date not null,
    `time` time not null,
    `status` varchar(50) not null,
    `doe` timestamp
)engine = InnoDB;


create table `message_reply`(
    `rid` int(255) not null primary key auto_increment,
    `mid` int(255) not null,
    `sender` varchar(100) not null,
    `text` longtext not null,
    `date` date not null,
    `time` time not null,
    `status` varchar(100) not null,
    `doe` timestamp
)engine = InnoDB;

create table `assignment`(
    `asID` int(255) not null primary key auto_increment,
    `cID` varchar(100) not null,
    `lecNum` int(10) not null,
    `type` varchar(100) not null,
    `question` longtext not null,
    `dueDate` date not null,
    `doe` datetime not null,
    `dor` timestamp
)engine = InnoDB;

create table `assignment_answers`(
    `id` int(255) not null primary key auto_increment,
    `asID` varchar(100) not null,
    `studentID` varchar(100) not null,
    `answer` longtext not null,
    `score` int(100) not null,
    `doe` timestamp
)engine = InnoDB;

/*
    ADDED 14TH APRIL 2020 11:22 AM
*/
CREATE TABLE `user_token` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `userID` varchar(80) NOT NULL,
  `token` varchar(80) NOT NULL,
  `timemodified` timestamp NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;











