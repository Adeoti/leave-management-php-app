-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2019 at 08:54 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `theleave`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ref` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ref`, `name`, `uname`, `password`, `date`) VALUES
(1, 'admin', 'admin', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `ref` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`ref`, `name`, `date`) VALUES
(4, 'Academic Distance Learning Programme', 'Mar 02,2019'),
(5, 'Entrepreneurship Development', 'Mar 02,2019'),
(7, 'Finance and Account', 'Mar 04,2019'),
(8, 'Trade Union Education', 'Mar 04,2019'),
(9, 'Human Resources', 'Mar 18,2019');

-- --------------------------------------------------------

--
-- Table structure for table `leavee`
--

CREATE TABLE IF NOT EXISTS `leavee` (
  `ref` int(11) NOT NULL AUTO_INCREMENT,
  `leave_name` varchar(100) NOT NULL,
  `staff_ref` varchar(100) NOT NULL,
  `staff_name` varchar(100) NOT NULL,
  `staff_dept` varchar(100) NOT NULL,
  `staff_level` varchar(100) NOT NULL,
  `leave_reason` text NOT NULL,
  `action_reason` text NOT NULL,
  `leave_contact` varchar(100) NOT NULL,
  `leave_year` varchar(100) NOT NULL,
  `leave_status` varchar(100) NOT NULL,
  `supervisor_ref` varchar(100) NOT NULL,
  `supervisor_name` varchar(100) NOT NULL,
  `date_approved` varchar(100) NOT NULL,
  `date_requested` varchar(100) NOT NULL,
  `date_elapsed` varchar(100) NOT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `leavee`
--

INSERT INTO `leavee` (`ref`, `leave_name`, `staff_ref`, `staff_name`, `staff_dept`, `staff_level`, `leave_reason`, `action_reason`, `leave_contact`, `leave_year`, `leave_status`, `supervisor_ref`, `supervisor_name`, `date_approved`, `date_requested`, `date_elapsed`) VALUES
(3, 'Congregation', '2', 'Adeoti Nurudeen', 'Academic Distance Learning Programme', '03', 'I will like to go very soon', '', '08062330920', '2019', '0', '', '', '', 'Mar 06,2019', ''),
(2, 'Casual', '2', 'Adeoti Nurudeen', 'Academic Distance Learning Programme', '03', 'ekebir   reiborbnfonbg vkjobnoebn f', 'gdf vfk,m', '08133370716', '2019', '3', '1', 'admin', 'Mar 12,2019', 'Mar 06,2019', '2019-03-12'),
(4, 'Study', '6', 'Ojukoju Micheal', 'Academic Distance Learning Programme', '03', 'I will like to go sir', 'Just too soon to request', '08062330920', '2019', '5', '2', 'AdeotiNurudeen', '', 'Mar 07,2019', ''),
(5, 'Congregation', '5', 'John Paul', 'Academic Distance Learning Programme', '03', 'Please allow me to go', 'It''s not good for now', '08062330920', '2019', '4', '1', 'admin', '', 'Mar 07,2019', ''),
(7, 'Study', '7', 'Alege Hawau', 'Academic Distance Learning Programme', '02', 'nbwrf nkj ji fjkv fv', 'good to go for the leave', '08133370716', '2019', '1', '2', 'Adeoti Nurudeen', '', 'Mar 12,2019', ''),
(9, 'Annual', '8', 'Timothy ODuwole', 'Entrepreneurship Development', '03', 'personal', '', '07036320207', '2019', '0', '', '', '', 'Mar 18,2019', ''),
(10, 'Annual', '9', 'Damilola Praise', 'Entrepreneurship Development', '02', 'Testing', 'It is just good', '08133370716', '2019', '5', '1', 'admin', 'Mar 18,2019', 'Mar 18,2019', '2019-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE IF NOT EXISTS `leave_type` (
  `ref` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`ref`, `name`, `department`, `level`, `duration`) VALUES
(3, 'Casual', 'all', 'all', '10 days'),
(4, 'Study', 'all', '10', '2 years'),
(5, 'Congregation', 'Entrepreneurship Development', '03', '12 days'),
(6, 'Annual', 'all', '02', '21');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `ref` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`ref`, `name`, `date`) VALUES
(5, '02', 'Mar 02,2019'),
(7, '03', 'Mar 02,2019');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `ref` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `msg` text NOT NULL,
  `sender_ref` varchar(100) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `receiver_ref` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`ref`, `subject`, `msg`, `sender_ref`, `sender_name`, `receiver_ref`, `date`) VALUES
(1, 'Forwarded', 'Your request has been forwarded by Adeoti Nurudeen.', '2', 'Adeoti Nurudeen', '5', 'Mar 08,2019'),
(2, 'Time Out !', 'Your leave has been brought to an end! .', '2', 'Adeoti Nurudeen', '6', 'Mar 08,2019'),
(3, 'Reversed', 'Your Approved leave has been reversed (stoped).', '1', 'admin', '5', 'Mar 08,2019'),
(4, 'Leave Rejected', 'Your request has been rejected by admin.', '2', 'admin', '', 'Mar 08,2019'),
(5, 'Leave Rejected', 'Your request has been rejected by admin.', '2', 'admin', '', 'Mar 08,2019'),
(6, 'Approved', 'Your request has been Approved by admin.', '1', 'admin', '2', 'Mar 12,2019'),
(7, 'Forwarded', 'Your request has been forwarded by Adeoti Nurudeen.', '2', 'Adeoti Nurudeen', '7', 'Mar 12,2019'),
(8, 'Approved', 'Your request has been Approved by admin.', '1', 'admin', '2', 'Mar 12,2019'),
(9, 'Approved', 'Your request has been Approved by admin.', '1', 'admin', '2', 'Mar 12,2019'),
(10, 'Approved', 'Your request has been Approved by admin.', '1', 'admin', '2', 'Mar 12,2019'),
(11, 'Reversed', 'Your Approved leave has been reversed (stoped).', '1', 'admin', '2', 'Mar 12,2019'),
(12, 'Reversed', 'Your Approved leave has been reversed (stoped).', '1', 'admin', '2', 'Mar 12,2019'),
(13, 'Approved', 'Your request has been Approved by admin.', '1', 'admin', '2', 'Mar 12,2019'),
(14, 'Forwarded', 'Your request has been forwarded by Timothy ODuwole.', '8', 'Timothy ODuwole', '9', 'Mar 18,2019'),
(15, 'Approved', 'Your request has been Approved by admin.', '1', 'admin', '9', 'Mar 18,2019'),
(16, 'Time Out !', 'Your leave has been brought to an end! Timothy ODuwole.', '8', 'Timothy ODuwole', '9', 'Mar 18,2019');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `ref` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `rank` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `dated` varchar(100) NOT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ref`, `fname`, `lname`, `email`, `signature`, `rank`, `department`, `level`, `dated`) VALUES
(2, 'Adeoti', 'Nurudeen', 'adeoti360@gmail.com', '00000', 'supervisor', 'Academic Distance Learning Programme', '03', 'Mar 04,2019'),
(3, 'Olayiwola', 'Princess', 'ola@gmail.com', '12345', 'supervisor', 'Finance and Account', '03', 'Mar 04,2019'),
(4, 'Olayiwola', 'Ibukun', 'ibukun@gmail.com', '12345', 'Normal Staff', 'Academic Distance Learning Programme', '03', 'Mar 07,2019'),
(8, 'Timothy', 'ODuwole', 'timo@gmail.com', '87654321', 'supervisor', 'Entrepreneurship Development', '03', 'Mar 18,2019'),
(9, 'Damilola', 'Praise', 'damilola@gmail.com', '12345678', 'Normal Staff', 'Entrepreneurship Development', '02', 'Mar 18,2019');
