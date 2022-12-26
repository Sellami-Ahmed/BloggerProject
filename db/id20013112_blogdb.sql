-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 25, 2022 at 11:47 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20013112_blogdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(23, 'Career Choice'),
(24, 'Tips'),
(26, 'Sound Engineers'),
(27, 'Best Courses ');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT -1,
  `submit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `valid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `header` varchar(200) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `likes` int(11) DEFAULT 0,
  `comments` int(11) DEFAULT 0,
  `submit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `title` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `tags` varchar(200) NOT NULL,
  `blogger` varchar(100) NOT NULL DEFAULT 'ahmed sellami'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `header`, `content`, `likes`, `comments`, `submit_date`, `title`, `category_id`, `views`, `tags`, `blogger`) VALUES
(16, 'Everyone overlooks the audio engineering in entertainment and media. Be it a concert, film or a video game’s impactful background score. Have you ever thought about how a movie today will be without m', 'Everyone overlooks the audio engineering in entertainment and media. Be it a concert, film or a video game’s impactful background score. Have you ever thought about how a movie today will be without music or sound? To say the least, it would disappoint. It’s the music and sound design that sets them apart. \r\n\r\nFilm scoring and sound design have really propelled the development of high-quality sound and it’s constantly improving. Now is the time for you to pursue a career in this field as this technology is still growing. In the past decade, there has been an increase in the number of sound engineering colleges in India, and many are choosing this industry as their main career. These are a few reasons why.\r\n\r\nNumerous Job Opportunities\r\nLike any other industry, sound engineering has many avenues to put your feet in. Recording, editing, producing, mixing, mastering, post-production, sound design for film, live sound for concerts, radio and live tv engineering are just a handful of areas ', 0, 0, '2022-12-15 02:35:47', 'Is Audio Engineering A Good Career Choice?', 23, 2, '#AudioEngineering#Career#BestChoice', 'ahmed sellami'),
(17, 'Understanding that starting your own business and running it successfully involves more than just selling the product or service that you offer, is when you become a true entrepreneur. The music indus', 'Understanding that starting your own business and running it successfully involves more than just selling the product or service that you offer, is when you become a true entrepreneur. The music industry in India is very competitive, and if you’re someone who has just finished their sound engineering courses in India or anything related, it is important to have a network of people who are willing to work with and help you.\r\n\r\nA passion for music is not enough to take you where you want to go, you need to be willing to put in the effort and persevere. A basic exposé on how to start your own music production business is provided in the article below, but keep in mind you’ll have to handle most of these tasks by yourself.\r\n\r\nBusiness Knowledge\r\n\r\nIn order to run a music production company you don’t have to know everything about recording consoles, microphones or daws, but learning your craft from a reputed sound engineering or music production colleges in India that teaches you all about ', 1, 0, '2022-12-15 02:38:52', 'Tips To Start a Music Production Company', 24, 6, '#Music#Production#Company#Start', 'ahmed sellami'),
(18, 'Have you heard of Sound Engineers? When you hear the term “Sound Engineer” you might have thought of a Music Composer or a Music Director. But the role of a sound engineer is far from the role of a mu', 'Have you heard of Sound Engineers? When you hear the term “Sound Engineer” you might have thought of a Music Composer or a Music Director. But the role of a sound engineer is far from the role of a music composer or a director. So, a sound engineer or audio engineer handles a recording or live performance by balancing, equalizing, and optimizing the music output. Thus, an audio engineer manages the technical aspect of the sound, from placing the microphones to equalizing the sound levels. Every sound engineering course in India teaches the students with practical sessions and practice to excel in their careers. So, if you wish to become a sound engineer, you should know the different types of sound engineers. Hence, listed below are some roles and job responsibilities of sound engineers.\r\n\r\nMonitor Sound Engineers:\r\nThe primary job of a Monitor Sound Engineer is to optimize and mix the sound that musicians hear onstage during the live performance. So, the onstage musicians produce soun', 0, 0, '2022-12-15 02:41:01', 'Different Types Of Sound Engineers', 26, 2, '#Types#SoundEngineers', 'ahmed sellami'),
(19, 'In any music concert or live performance, the vocals play a vital part. However, if the vocals are not appropriately expressed, it can spoil the entire performance. Thus, it would be best to have a pr', 'In any music concert or live performance, the vocals play a vital part. However, if the vocals are not appropriately expressed, it can spoil the entire performance. Thus, it would be best to have a professional sound engineer make the vocal sound clear. The students from music production colleges in India use different ways to make vocals sound modern and professional. The contemporary pop style vocals need more techniques to make their vocal sound effectively. So, let us walk through the ways to improve your vocals.\r\n\r\nTop-end boost:\r\nThe primary way used by the music engineers to improve the vocals is to boost the top-end. The boost term refers to the increase in the amplitude of the sound level. For example, if an audio engineer says “boost 4k”, the gain or amplitude of the equalizer is being increased to 4000Hz. Thus, increasing the frequency does not change anything; instead, the gain of the frequency should be increased to make the vocal sound better. However, the expensive micro', 0, 0, '2022-12-15 02:43:19', 'Different Ways To Make Vocals Sound Modern & Professional', 24, 1, '#Vocals#Mixing#Mastering', 'ahmed sellami'),
(20, 'You’ve finished school and have a passion for music. Probably a musician who loves playing or an enthusiast who discovered the soundscapes behind intense dialogues and violent scenes augment the exper', 'You’ve finished school and have a passion for music. Probably a musician who loves playing or an enthusiast who discovered the soundscapes behind intense dialogues and violent scenes augment the experience of a movie. A quick google search reveals that an Audio Engineer, Film score Composer, Music Programmer, Music Producer, or someone else does this as a profession. Another simple query leads to the educational qualification of these creative giants, and you’re determined to get started. Let’s get a Degree my parents and I will be proud of. A passion and a degree in one? It’s a miracle! Your dream can now start at one of the best sound engineering colleges in India.\r\n\r\nAnother Google Search brings disappointment. All good things must come to an end. A Bachelor’s Degree from a recognised university is hard to find, and on finding such a course, you discover that you’ve got subjects you spent the latter half of your High school loathing! And there are these other Diplomas and Certificat', 0, 0, '2022-12-15 02:46:01', 'Best Music Production Courses In India', 27, 1, '#Music#Production#Courses', 'ahmed sellami'),
(21, 'What are Levels? The easiest way to capture sound is by converting sound energy into electrical energy. There have been attempts to capture sound on wax cylinders but the quality and volume that was a', 'What are Levels?\r\n\r\nThe easiest way to capture sound is by converting sound energy into electrical energy. There have been attempts to capture sound on wax cylinders but the quality and volume that was achieved weren’t great for anything other than speech. Then they moved onto circular lacquer disk which evolved into the vinyl disk we know and love. Then came the era of Tape Machines, the best way to record music in my opinion, I digress. The microphone facilitated the recording of audio for the longest time. And the output from the microphone was very minute electrical signals and, with the standardization of dBV during the development of the industry, was measured to be between -60dBu to -40dBu(Decibel measurement concerning voltage).\r\n\r\n \r\n\r\nHow did they come up with levels?\r\n\r\nCBS, NBC and Bell Labs developed the VU meter in 1939 to visually exhibit the perceived loudness of the audio signal. The Acoustical Society of America then standardized it in 1942(ANSI C16.5-1942). 0 VU is e', 1, 0, '2022-12-15 02:47:21', 'What are Levels?', 24, 14, '#Lavels#Mixing', 'ahmed sellami');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `likedPost` varchar(128) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `usersEmail`, `usersUid`, `usersPwd`, `isAdmin`, `likedPost`) VALUES
(1, 'Omar', 'omar.rebai@enis.tn', 'Omar', '123', 1, '#'),
(2, 'ahmed sellami', 'ahmed.sellami@enis.tn', 'ahmedsellami', '123', 1, '##7#7/#8#8/#21#17'),
(4, 'Omar Rebai', 'omar@gmail.com', 'Rebai', '123', 0, '#'),
(5, 'Lam3i', 'boudam3a@gmail.com', 'Lam3iB', '123', 0, '#'),
(6, 'Azerty', 'nb@hg.hg', 'Omar', '123', 0, '#');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
