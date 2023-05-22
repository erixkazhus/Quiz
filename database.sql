CREATE DATABASE quiz_app;

USE quiz_app;


--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `qid` int NOT NULL AUTO_INCREMENT,
  `test_id` int NOT NULL,
  `qno` int NOT NULL,
  `question` text NOT NULL,
  `ans1` text NOT NULL,
  `ans2` text NOT NULL,
  `ans3` text NOT NULL,
  `ans4` text NOT NULL,
  `correct_answer` varchar(1) NOT NULL,
  PRIMARY KEY (`qid`),
  KEY `test_id` (`test_id`,`qno`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `test_id`, `qno`, `question`, `ans1`, `ans2`, `ans3`, `ans4`, `correct_answer`) VALUES
(21, 1, 5, 'What is a correct way to add a comment in PHP?', '&lt;!--&hellip;--&gt;', '/*&hellip;*/', '*\\..\\*', '&lt;comment&gt;&hellip;&lt;/comment&gt;', 'b'),
(22, 1, 3, 'The PHP syntax is most similar to:', 'Perl and C', 'VBscript', 'Javascript', 'none of these', 'a'),
(23, 1, 2, 'How do you write \"Hello World\" in PHP?', 'echo \"Hello World\";', 'Document.Write(\"Hello World\");', '\"Hello World\";', 'none of these', 'a'),
(24, 1, 1, 'What does PHP stand for?', 'Personal Hypertext Processor\r\n', 'Private Home Page', 'Personal Home Page', 'PHP: Hypertext Preprocessor', 'd'),
(25, 1, 4, 'How do you get information from a form that is submitted using the &quot;get&quot; method?', '$_GET[];', 'Request.Form;', 'Request.QueryString;', 'none of these', 'a'),
(26, 2, 1, 'When using the POST method, variables are displayed in the URL:', 'True', 'False', 'Can\'t say', 'none of these', 'b'),
(27, 2, 2, 'Which of the following functions is used to get the size of a file?', 'fopen()', 'fread()', 'fsize()', 'filesize()', 'd'),
(28, 2, 3, 'Which of the following is used to delete a cookie?', 'setcookie()', '$_COOKIE variable', 'isset() function', 'none of the above', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `test_id` int NOT NULL AUTO_INCREMENT,
  `test_name` varchar(255) NOT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `test_name`) VALUES
(1, 'Test 1'),
(2, 'Test 2'),
(3, 'Test 3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `played_on` varchar(225) NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `played_on`, `score`) VALUES
(81, 'john', '2023-05-21 14:32:57', 0)

COMMIT;

