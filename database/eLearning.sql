-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2017 at 11:19 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ol_elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_answer`
--

CREATE TABLE IF NOT EXISTS `olala3w_answer` (
`answer_id` double NOT NULL,
  `test_id` int(11) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `correct` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `olala3w_answer`
--

INSERT INTO `olala3w_answer` (`answer_id`, `test_id`, `title`, `correct`) VALUES
(19, 5, 'Câu 1', 0),
(20, 5, 'Câu 2', 0),
(21, 5, 'Câu 3', 0),
(22, 5, 'Câu 4', 1),
(23, 5, 'Câu 5', 1),
(24, 5, 'Câu 6', 1),
(25, 5, 'Câu 7', 1),
(30, 9, 'Đáp án A', 0),
(31, 9, 'Đáp án B', 1),
(32, 9, 'Đáp án C', 0),
(33, 9, 'Đáp án D', 0),
(34, 10, 'Đáp án A', 0),
(35, 10, 'Đáp án B', 1),
(36, 10, 'Đáp án C', 0),
(37, 10, 'Đáp án D', 1),
(38, 10, 'Đáp án E', 1),
(39, 10, 'Đáp án F', 0),
(40, 8, 'Đáp án A', 0),
(41, 8, 'Đáp án B', 0),
(42, 8, 'Đáp án C', 1),
(43, 8, 'Đáp án D', 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_answer_logs`
--

CREATE TABLE IF NOT EXISTS `olala3w_answer_logs` (
`answer_logs_id` double NOT NULL,
  `test_logs_id` int(11) NOT NULL DEFAULT '0',
  `test_id` int(11) NOT NULL DEFAULT '0',
  `answer_id` double NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL DEFAULT '0',
  `answer` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `olala3w_answer_logs`
--

INSERT INTO `olala3w_answer_logs` (`answer_logs_id`, `test_logs_id`, `test_id`, `answer_id`, `type`, `answer`) VALUES
(74, 23, 8, 28, 0, ''),
(75, 23, 9, 31, 0, ''),
(76, 23, 10, 35, 0, ''),
(77, 23, 10, 37, 0, ''),
(78, 23, 10, 38, 0, ''),
(79, 23, 11, 0, 1, ''),
(80, 24, 11, 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_article`
--

CREATE TABLE IF NOT EXISTS `olala3w_article` (
`article_id` int(11) NOT NULL,
  `article_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `folder` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT '-no-',
  `img_note` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `upload_id` bigint(20) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `content` longtext NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=852 ;

--
-- Dumping data for table `olala3w_article`
--

INSERT INTO `olala3w_article` (`article_id`, `article_menu_id`, `name`, `title`, `description`, `keywords`, `folder`, `img`, `img_note`, `address`, `price`, `upload_id`, `comment`, `content`, `is_active`, `hot`, `views`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(836, 423, 'Lê Thẩm Dương', '', '', '', '', 'kp070uxs3g0nrlq-836-le-tham-duong.jpg', '', '', 0, 1564, 'Tiến sĩ', '<p>TS. Lê Thẩm Dương được biết đến không chỉ là một giảng viên xuất sắc của Khoa Quản trị Kinh doanh, Đại học Ngân Hàng TP. HCM mà còn được biết đến với một thương hiệu là một diễn giả chuyên nghiệp, một chuyên gia hàng đầu trong nhiều lĩnh vực đào tạo, hoạt động thực tiễn...</p>\r\n\r\n<p>• Năm 1982-1989: Giảng viên, Học viện Ngân hàng, Hà Nội</p>\r\n\r\n<p>• Năm 1989-1998: Giảng viên, Đại học Ngân hàng, Tp.HCM</p>\r\n\r\n<p>• Năm 1998-2005, Giảng viên, Phó Trưởng khoa, Khoa Tín dụng Ngân hàng, ĐH Ngân hàng Tp.HCM</p>\r\n\r\n<p>• Năm 2005-nay, Giảng viên, Trưởng khoa, Khoa Quản trị Kinh doanh, ĐH Ngân hàng Tp.HCM</p>\r\n\r\n<p>• Thành viên của tổ viết bài của Thống đốc Ngân hàng Nhà nước Việt Nam (1 trong 8 thành viên). Giảng viên chính Chương trình Cấp Chứng chỉ Hành nghề của Uỷ ban Chứng khoán Nhà nước. Tư vấn Nghiệp vụ và Quản trị cho các NHTM như NH Nông nghiệp Tân Bình, NH Miền Tây, NH Công Thương. Tư vấn Quản trị cho Báo Tuổi trẻ, Bưu điện Đồng Nai, Hoàng Anh Gia lai, Mai Linh...</p>\r\n\r\n<p>• Khách mời thường xuyên (hơn 2 lần/tuần) về mảng Kinh doanh và Chứng khoán của Đài Truyền hình Việt Nam VTV, VTV9 và các Đài Truyền hình địa phương HTV, BTV. Khách mời, chủ toạ thường xuyên của các diễn đàn cấp Quốc gia và khu vực như diễn đàn “Triển vọng Kinh tế 2008/2009, 2009/2010/ 2011, tìm vốn cho doanh nghiệp vừa và nhỏ, Thị trường Chứng khoán Việt Nam qua từng giai đoạn, các giải pháp hạn chế lạm phát,...</p>\r\n\r\n<p>• Thường xuyên tham gia trả lời Trực tuyến trên Tuổi Trẻ online và Thanh niên online về Kinh tế, hoạt động Kinh doanh và Thị trường Chứng khoán. Giảng viên thỉnh giảng thường xuyên các Chương trình Đào tạo ngắn ngày của Học viện Kent, Trung tâm Bồi dưỡng Nghiệp vụ Đại học Ngân hàng Tp.HCM, Trung tâm CPE Đà Nẵng, ImPak...</p>\r\n\r\n<p>• Trực tiếp giảng dạy và tư vấn cho các NH thường xuyên 8 khóa/ năm, tại trường Đại học NH TPHCM. Trực tiếp giảng dạy tại các NH BIDV, Nông nghiệp &amp; Phát triển Nông thôn, Công Thương Việt Nam, Ngoại thương Việt Nam – với số lượng lớn các chi nhánh – và các Ngân hàng Cổ phần, Dầu khí, Nam Á, Á Châu, Việt Á...</p>\r\n', 1, 0, 38, 1476495960, 1, 1477321611, 0),
(837, 423, 'Nguyễn Danh Tú', '', '', '', 'admin\\11-2016\\', 'nguyen-danh-tu-837.png', '', '', 0, 1565, 'Giảng viên', '<p>Nguyên Giám đốc tài chính cho Doanh nghiệp có hơn 600 nhân viên</p>\r\n\r\n<p>15+ năm kinh nghiệm giảng dạy tại Đại học Bách Khoa Hà Nội và BKIndex</p>\r\n\r\n<p>5+ năm kinh nghiệm trong lĩnh vực sư phạm và đào tạo trên môi trường trực tuyến E-learning.</p>\r\n\r\n<p>12+ năm kinh nghiệm trong lĩnh vực Tin học văn phòng trong công việc và cải tiến quy trình</p>\r\n\r\n<p>20+ khóa học dành riêng cho người đi làm với chuyên đề Excel.</p>\r\n\r\n<p>100+ khóa giảng dạy chuyên đề, kỹ năng về ứng dụng CNTT trong làm việc</p>\r\n', 1, 0, 1, 1476496200, 1, 1480264828, 1),
(851, 420, 'Học tiếng Anh: Michelle Obama sẽ không chạy đua vào Nhà Trắng', '', '', '', 'admin\\12-2016\\', 'hoc-tieng-anh-michelle-obama-se-khong-chay-dua-vao-nha-trang-851.jpg', '', '', 0, 1589, 'Theo Obama, một trong những việc chắc chắn nhất cuộc đời ông là Michelle sẽ không tranh cử tổng thống. Nghe video và điền từ còn thiếu vào chỗ trống.', '<div>\r\n<p>Since you can’t run again for another term, is there any way that we as a group can talk the First Lady into running?</p>\r\n\r\n<p>Obama: No. Let me tell you, there are 3 things that are certain in life. …(1)…, taxes and Michelle is not running for …(2)…&nbsp;That I can tell you. But you know what, the First Lady, though, the work she’s done around&nbsp;reducing childhood obesity, the work that she and Jill Biden have done on&nbsp;military families&nbsp;and making sure they get …(3)…, I could not be prouder of her. And I am …(3)…&nbsp;that she’s going to be really active as a First Lady.</p>\r\n\r\n<p>Not only she is going to be a very…(4)… &nbsp;ex-First Lady, but unlike me, she looks …(4)…&nbsp;I was looking at a …(5)…&nbsp;picture – actually, we found the old video from our …(5)…&nbsp;We’ve been married 23 years now. And so my&nbsp;mother-in-law&nbsp;had been going through some&nbsp;storage stuff&nbsp;and found our …(6)…&nbsp;And I popped it in. And I look like a teenager and realize, boy, I sure&nbsp;have aged. I know that, though. But Michelle looked&nbsp;identical. Well, I’m proud of her, too, because most importantly she’s been an unbelievable …(7)…, which is why my daughters turned out so well.</p>\r\n\r\n<p><u><strong>Từ mới:</strong></u></p>\r\n\r\n<p>reducing childhood obesity: giảm béo phì ở trẻ em</p>\r\n\r\n<p>military families: gia đình quân nhân</p>\r\n\r\n<p>mother-in-law: mẹ vợ, mẹ chồng</p>\r\n\r\n<p>storage stuff: vật lưu trữ</p>\r\n\r\n<p>have aged: có tuổi, già đi</p>\r\n\r\n<p>identical: giống hệt</p>\r\n</div>\r\n\r\n<p style="text-align: right;"><strong>Phiêu Linh</strong></p>\r\n', 1, 0, 32, 1480867020, 1, 1481448181, 0),
(849, 430, 'Phần mềm 1', '', '', '', 'admin\\11-2016\\', '-no-', '', '', 0, 1587, '', '<p>Đang cập nhật...</p>\r\n', 1, 0, 13, 1480263540, 1, 1480264537, 1),
(841, 413, 'Giới thiệu chung', '', '', '', '', '-no-', '', '', 0, 1569, '', '<h2 style="text-align: center;">Giới thiệu chung</h2>\r\n\r\n<p>Edumall tự hào là "siêu thị" các khóa học trực tuyến ngắn hạn lớn nhất tại Việt Nam.</p>\r\n\r\n<h3 style="text-align: center;">Kho học trực tuyến khổng lồ Edumall</h3>\r\n\r\n<p>Với hàng nghìn khóa học thuộc đủ các lĩnh vực học tập khác nhau mang tính ứng dụng cao như: Công nghệ thông tin, Kinh doanh khởi nghiệp, Phát triển cá nhân, Marketing, Design, Nuôi dạy con ..., học viên có thể dễ dàng lựa chọn được khóa học phù hợp với nhu cầu học tập của mình với chi phí chỉ bằng 1/5 chi phí tại các lớp học truyền thống.</p>\r\n\r\n<p>Không cần chờ mở lớp, không phải băn khoăn thời gian học, không lo hết hạn, học viên hoàn toàn chủ động về thời gian học tập. Chỉ với các thiết bị có kết nối internet: máy tính, điện thoại, iPad, tablet, ..., học viên có thể đăng nhập vào lớp học và tận hưởng thời gian học tập bổ ích ngay bất kì nơi đâu.</p>\r\n\r\n<h3 style="text-align: center;">Chỉ có tại Edumall</h3>\r\n\r\n<p>Tài khoản học tập trọn đời với thời gian học tập không giới hạn</p>\r\n\r\n<p>Các bài giảng trong chương trình đều đạt chuẩn quốc tế và được giảng dạy bởi các giảng viên, diễn giả, chuyên gia hàng đầu Việt Nam như Tiến sĩ kinh tế Lê Thẩm Dương, Th.S Trần Nam Anh, MC Phan Phúc Thắng, Th.S Trần Thị Ái Liên, Th.S Nguyễn Danh Tú ... Học viên có thể học mọi lúc, mọi nơi thông qua các thiết bị số (điện thoại, máy tính,…) với các bài học đạt chuẩn chất lượng HD đi kèm với hệ thống hỗ trợ kĩ thuật và chăm sóc khách hàng nhiệt tình và chuyên nghiệp.</p>\r\n\r\n<p>Chúng tôi cũng cam kết hoàn 100% học phí cho học viên theo chính sách hoàn học phí của Edumall.</p>\r\n', 1, 0, 93, 1476976860, 1, 1476983666, 0),
(842, 414, 'Làm thế nào để kích hoạt được khoá học trên e-Learning?', '', '', '', '', '-no-', '', '', 0, 1570, '', '<p>Đang cập nhật...</p>\r\n', 1, 0, 1, 1476976980, 1, 1476977106, 0),
(843, 414, 'Mã kích hoạt được sử dụng bao nhiêu lần?', '', '', '', '', '-no-', '', '', 0, 1571, '', '<p>Đang cập nhật...</p>\r\n', 1, 0, 1, 1476975900, 1, 1476977191, 0),
(844, 414, 'Làm sao để đăng ký và đăng nhập vào e-Learning?', '', '', '', '', '-no-', '', '', 0, 1572, '', '<p>Đang cập nhật...</p>\r\n', 1, 0, 3, 1476976200, 1, 1476977181, 0),
(845, 415, 'Điều khoản sử dụng', '', '', '', '', '-no-', '', '', 0, 1573, '', '<h2 style="text-align: center;">Điều khoản sử dụng</h2>\r\n\r\n<p>Về tài khoản sử dụng: Khi đăng ký tài khoản, người sử dụng (NSD) phải cung cấp đầy đủ và chính xác thông tin về Tên, Email, Số điện thoại... Đây là những thông tin bắt buộc liên quan tới việc hỗ trợ NSD trong quá trình sử dụng dịch vụ tại Edumall.vn. Vì vậy khi có những rủi ro, mất mát sau này, Edumall chỉ tiếp nhận những trường hợp điền đúng và đầy đủ những thông tin trên. Những trường hợp điền thiếu thông tin hoặc thông tin sai sự thật sẽ không được giải quyết. Những thông tin này sẽ được dùng làm căn cứ để hỗ trợ giải quyết.</p>\r\n\r\n<p>Mật khẩu của tài khoản (MKTK): Sau khi thanh toán, Trong phần quản lý tài khoản, đối với một tài khoản, NSD sẽ có một mật khẩu. Mật khẩu được sử dụng để đăng nhập vào các website và các dịch vụ trong hệ thống của Edumall. NSD có trách nhiệm phải tự mình bảo quản mật khẩu, nếu mật khẩu bị lộ ra ngoài dưới bất kỳ hình thức nào, Edumall sẽ không chịu trách nhiệm về mọi tổn thất phát sinh.</p>\r\n\r\n<p>Tuyệt đối không sử dụng bất kỳ chương trình, công cụ hay hình thức nào khác để can thiệp vào các khóa học của Edumall. Mọi vi phạm khi bị phát hiện sẽ bị xóa tài khoản và có thể xử lý theo quy định của pháp luật.</p>\r\n\r\n<p>Nghiêm cấm việc phát tán, truyền bá hay cổ vũ cho bất kỳ hoạt động nào nhằm can thiệp, phá hoại hay xâm nhập vào dữ liệu của các khóa học trong hệ thống của Edumall. Nghiêm cấm việc sử dụng chung tài khoản. Việc trên 2 người cùng sử dụng chung một tài khoản khi bị phát hiện sẽ bị xóa tài khoản ngay lập tức.</p>\r\n\r\n<p>Nghiêm cấm việc phát tán nội dung các bài học trên hệ thống của Edumall ra bên ngoài. Mọi vi phạm khi bị phát hiện sẽ bị xóa tài khoản và có thể xử lý theo quy định của pháp luật về việc vi phạm bản quyền.</p>\r\n\r\n<p>Không được có bất kỳ hành vi nào nhằm đăng nhập trái phép hoặc tìm cách đăng nhập trái phép cũng như gây thiệt hại cho hệ thống máy chủ của Edumall. Mọi hành vi này đều bị xem là những hành vi phá hoại tài sản của người khác và sẽ bị tước bỏ mọi quyền lợi đối với tài khoàn cũng như sẽ bị truy tố trước pháp luật nếu cần thiết.</p>\r\n\r\n<p>Khi giao tiếp với người dùng khác trong hệ thống dịch vụ của Edumall, NSD không được quấy rối, chửi bới, làm phiền hay có bất kỳ hành vi thiếu văn hoá nào đối với người khác. Tuyệt đối nghiêm cấm việc xúc phạm, nhạo báng người khác dưới bất kỳ hình thức nào (nhạo báng, chê bai, kỳ thị tôn giáo, giới tính, sắc tộc….).</p>\r\n\r\n<p>Tuyệt đối nghiêm cấm mọi hành vi mạo nhận hay cố ý làm người khác tưởng lầm mình là một người sử dụng khác trong hệ thống dịch vụ của Edumall. Mọi hành vi vi phạm sẽ bị xử lý hoặc xóa tài khoản.</p>\r\n\r\n<p>Khi phát hiện những vi phạm như vi phạm bản quyền, hoặc những lỗi vi phạm quy định khác, Edumall có quyền sử dụng những thông tin mà NSD cung cấp khi đăng ký tài khoản để chuyển cho Cơ quan chức năng giải quyết theo quy định của pháp luật.</p>\r\n\r\n<p>Trong những trường hợp bất khả kháng như chập điện, hư hỏng phần cứng, phần mềm, hoặc do thiên tai .v.v. NSD phải chấp nhận những thiệt hại nếu có.</p>\r\n\r\n<p>Tuyệt đối nghiêm cấm mọi hành vi tuyên truyền, chống phá và xuyên tạc chính quyền, thể chế chính trị, và các chính sách của Nhà nước... Trường hợp phát hiện, không những bị xóa bỏ tài khoản mà chúng tôi còn có thể cung cấp thông tin của NSD đó cho các cơ quan chức năng để xử lý theo pháp luật.</p>\r\n\r\n<p>Tuyệt đối không bàn luận về các vấn đề chính trị, kỳ thị tôn giao, kỳ thị sắc tộc. Không có những hành vi, thái độ làm tổn hại đến uy tín của các sản phẩm, dịch vụ, khóa học trong hệ thống Edumall dưới bất kỳ hình thức nào, phương thức nào. Mọi vi phạm sẽ bị tước bỏ mọi quyền lợi liên quan đối với tài khoản hoặc xử lý trước pháp luật nếu cần thiết. Mọi thông tin cá nhân của NSD sẽ được chúng tôi bảo mật, không tiết lộ ra ngoài. Chúng tôi không bán hay trao đổi những thông tin này với bất kỳ một bên thứ ba nào khác. Như trên đã nói, mọi thông tin đăng ký của NSD sẽ được bảo mật, nhưng trong trường hợp cơ quan chức năng yêu cầu, chúng tôi sẽ buộc phải cung cấp những thông tin này cho các cơ quan chức năng.</p>\r\n\r\n<p>Edumall có toàn quyền xóa, sửa chữa hay thay đổi các dữ liệu, thông tin tài khoản của NSD trong các trường hợp người đó vi phạm những qui định kể trên mà không cần sự đồng ý của người sử dụng.</p>\r\n\r\n<p>Edumall có thể thay đổi, bổ sung hoặc sửa chữa thỏa thuận này bất cứ lúc nào và sẽ công bố rõ trên Website hoặc các kênh truyền thông chính thức khác của Edumall.</p>\r\n', 1, 0, 19, 1476983460, 1, 1476983649, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_article_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_article_menu` (
`article_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT 'not-found',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `comment` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `folder` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT '-no-',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=435 ;

--
-- Dumping data for table `olala3w_article_menu`
--

INSERT INTO `olala3w_article_menu` (`article_menu_id`, `category_id`, `name`, `slug`, `title`, `description`, `keywords`, `parent`, `sort`, `comment`, `icon`, `is_active`, `hot`, `folder`, `img`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(430, 94, 'Phần mềm hỗ trợ học tập', 'phan-mem-ho-tro-hoc-tap', '', '', '', 0, 7, '', 'mdi-puzzle', 1, 1, 'admin\\11-2016\\', '-no-', 1480263562, 1, 1480264743, 1),
(425, 95, 'Toán học', 'toan-hoc', '', '', '', 0, 3, '', '', 1, 0, '', '-no-', 1476462465, 1, 1476462465, 0),
(424, 95, 'Ngoại ngữ', 'ngoai-ngu', '', '', '', 0, 2, '', '', 1, 0, '', '-no-', 1476462456, 1, 1476462456, 0),
(423, 95, 'Công nghệ thông tin', 'cong-nghe-thong-tin', '', '', '', 0, 1, '', '', 1, 0, '', '-no-', 1476462441, 1, 1476462441, 0),
(413, 94, 'Giới thiệu', 'gioi-thieu', '', '', '', 0, 1, '', '', 1, 0, '', '-no-', 1476296765, 1, 1480263708, 0),
(414, 94, 'Câu hỏi thường gặp', 'cau-hoi-thuong-gap', '', '', '', 0, 2, '', '', 1, 0, '', '-no-', 1476296774, 1, 1476296774, 0),
(415, 94, 'Điều khoản sử dụng', 'dieu-khoan-su-dung', '', '', '', 0, 3, '', '', 1, 0, '', '-no-', 1476296785, 1, 1480263745, 0),
(416, 94, 'Quy chế hoạt động', 'quy-che-hoat-dong', '', '', '', 0, 4, '', '', 1, 0, '', '-no-', 1476296795, 1, 1476978570, 0),
(417, 94, 'Chính sách bảo mật', 'chinh-sach-bao-mat', '', '', '', 0, 5, '', '', 1, 0, '', '-no-', 1476296805, 1, 1476296805, 0),
(427, 94, 'Chính sách thành viên', 'chinh-sach-thanh-vien', '', '', '', 0, 6, '', '', 1, 0, 'admin\\11-2016\\', '-no-', 1476986619, 1, 1479756947, 1),
(420, 90, 'Tin hoạt động', 'tin-hoat-dong', '', '', '', 0, 1, '', '', 1, 0, '', '-no-', 1476296848, 1, 1476296848, 0),
(421, 90, 'Sự kiện nổi bật', 'su-kien-noi-bat', '', '', '', 0, 2, '', '', 1, 0, '', '-no-', 1476296861, 1, 1480131606, 0),
(431, 90, 'Level 1', 'level-1', '', '', '', 420, 1, '', '', 1, 0, 'admin\\12-2016\\', '-no-', 1481448132, 1, 1481448132, 0),
(432, 90, 'Level 2', 'level-2', '', '', '', 420, 2, '', '', 1, 0, 'admin\\12-2016\\', '-no-', 1481448138, 1, 1481448138, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_bds_business`
--

CREATE TABLE IF NOT EXISTS `olala3w_bds_business` (
`bds_business_id` int(11) NOT NULL,
  `bds_business_menu_id` int(11) NOT NULL,
  `type_show` int(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `project` int(11) NOT NULL DEFAULT '0',
  `street` varchar(255) NOT NULL,
  `street_slug` varchar(255) NOT NULL,
  `road` int(11) NOT NULL DEFAULT '0',
  `floors` int(11) NOT NULL DEFAULT '0',
  `view_direction` int(11) NOT NULL DEFAULT '0',
  `view_scene` varchar(255) NOT NULL,
  `direction` int(11) NOT NULL DEFAULT '0',
  `location` int(11) NOT NULL DEFAULT '0',
  `geo_radius` int(11) NOT NULL DEFAULT '0',
  `area_land` double NOT NULL DEFAULT '0',
  `area_use` double NOT NULL DEFAULT '0',
  `price_total_land` bigint(20) NOT NULL DEFAULT '0',
  `price_unit_land` bigint(20) NOT NULL DEFAULT '0',
  `price_house` bigint(20) NOT NULL DEFAULT '0',
  `price_house_m2` int(20) NOT NULL DEFAULT '0',
  `price_total_house_land` bigint(20) NOT NULL,
  `transactions_deposit` bigint(20) NOT NULL DEFAULT '0',
  `transactions_duration` varchar(255) NOT NULL,
  `transactions_contract` int(1) NOT NULL DEFAULT '0',
  `transactions_type` int(1) NOT NULL DEFAULT '0',
  `purpose_use_land` varchar(255) NOT NULL,
  `law_land` int(11) NOT NULL DEFAULT '0',
  `parallel_price` text NOT NULL,
  `infrastructure_lights` varchar(255) NOT NULL,
  `infrastructure_water` varchar(255) NOT NULL,
  `infrastructure_view` varchar(255) NOT NULL,
  `infrastructure_land` int(11) NOT NULL DEFAULT '0',
  `infrastructure_floors` int(11) NOT NULL DEFAULT '0',
  `type_house` int(11) NOT NULL DEFAULT '0',
  `social_05km` text NOT NULL,
  `social_1km` text NOT NULL,
  `social_3km` text NOT NULL,
  `social_10km` text NOT NULL,
  `social_street` text NOT NULL,
  `social_educate` text NOT NULL,
  `created_time` int(11) NOT NULL DEFAULT '0',
  `expiration_time` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `transactors` int(1) NOT NULL DEFAULT '0',
  `contact_name` varchar(255) NOT NULL,
  `contact_tell` varchar(20) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `upload_id` bigint(20) NOT NULL DEFAULT '0',
  `upload_idd` bigint(20) NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=443 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_bds_business_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_bds_business_menu` (
`bds_business_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT 'not-found',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=153 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_car`
--

CREATE TABLE IF NOT EXISTS `olala3w_car` (
`car_id` int(11) NOT NULL,
  `car_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `img_note` varchar(255) NOT NULL,
  `upload_id` bigint(20) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `seat` varchar(255) NOT NULL,
  `seat_sort` int(11) NOT NULL DEFAULT '0',
  `color` varchar(255) NOT NULL,
  `price` bigint(15) NOT NULL,
  `sale` int(3) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `content` longtext NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=312 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_car_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_car_menu` (
`car_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT 'not-found',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `comment` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=188 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_category`
--

CREATE TABLE IF NOT EXISTS `olala3w_category` (
`category_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `plus` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `comment` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `menu_main` int(1) NOT NULL DEFAULT '0',
  `sort_hide` int(11) NOT NULL DEFAULT '1',
  `menu_sm` int(1) NOT NULL DEFAULT '0',
  `folder` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT '-no-',
  `icon` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `olala3w_category`
--

INSERT INTO `olala3w_category` (`category_id`, `type_id`, `name`, `slug`, `plus`, `title`, `description`, `keywords`, `comment`, `is_active`, `hot`, `sort`, `menu_main`, `sort_hide`, `menu_sm`, `folder`, `img`, `icon`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(89, 6, 'Khóa học', 'khoa-hoc', '', '', '', '', '', 1, 0, 1, 1, 2, 0, 'admin\\11-2016\\', 'khoa-hoc-89.jpg', 'fa fa-cubes fa-lg fa-fw', 0, 1, 1479753555, 0),
(90, 1, 'Tin tức - Sự kiện', 'tin-tuc', '', '', '', '', '', 1, 0, 2, 1, 6, 0, '', '-no-', 'fa fa-newspaper-o fa-lg fa-fw', 0, 1, 1482096539, 0),
(95, 1, 'Giảng viên', 'giang-vien', '', '', '', '', '', 1, 0, 3, 0, 1, 0, '', '-no-', '', 0, 0, 1476462420, 0),
(94, 1, 'Về e-Learning', 'bai-viet', '', '', '', '', '', 1, 0, 1, 1, 1, 0, '', '-no-', 'fa fa-question-circle fa-lg fa-fw', 0, 1, 1482096535, 0),
(96, 17, 'Diễn đàn', 'dien-dan', '', '', '', '', '', 1, 0, 1, 0, 1, 0, '', '-no-', '', 0, 0, 0, 0),
(91, 2, 'Slider', 'slider', '', '', '', '', '', 1, 0, 1, 0, 1, 0, '', '-no-', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_category_type`
--

CREATE TABLE IF NOT EXISTS `olala3w_category_type` (
`type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `olala3w_category_type`
--

INSERT INTO `olala3w_category_type` (`type_id`, `name`, `slug`, `sort`, `is_active`) VALUES
(1, 'Bài viết', 'article_manager', 1, 1),
(2, 'Hình ảnh', 'gallery_manager', 2, 1),
(7, 'Đăng ký email', 'register_email', 9, 0),
(6, 'Đào tạo', 'product_manager', 3, 1),
(8, 'Booking online', 'order_list', 7, 0),
(9, 'Tour du lịch', 'tour_manager', 5, 0),
(10, 'Đồ lưu niệm', 'gift_manager', 0, 0),
(11, 'Thuê xe', 'car_manager', 6, 0),
(12, 'Vị trí địa lý', 'location_manager', 0, 0),
(13, 'Dữ liệu đường phố', 'street_manager', 0, 0),
(14, 'Dữ liệu phương hướng', 'direction_manager', 0, 0),
(15, 'Dữ liệu khác', 'others_manager', 5, 1),
(16, 'Chiều rộng đường', 'road_manager', 0, 0),
(17, 'Diễn đàn', 'forum_manager', 4, 1),
(18, 'BĐS kinh doanh', 'bds_business_manager', 0, 0),
(19, 'Dữ liệu tên dự án', 'prjname_manager', 0, 0),
(20, 'Thư liên hệ', 'contact_list', 8, 1),
(21, 'Văn bản / Tài liệu', 'document_manager', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_constant`
--

CREATE TABLE IF NOT EXISTS `olala3w_constant` (
`constant_id` int(11) NOT NULL,
  `constant` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `olala3w_constant`
--

INSERT INTO `olala3w_constant` (`constant_id`, `constant`, `value`, `name`, `type`, `sort`) VALUES
(1, 'date', 'd/m/Y', 'Kiểu hiển thị ngày tháng năm', 3, 1),
(2, 'time', 'H:i', 'Kiểu hiển thị giờ phút', 3, 2),
(3, 'timezone', 'Asia/Bangkok', 'Múi giờ', 3, 4),
(4, 'title', 'Khóa học trực tuyến | Trung tâm e-Learning', 'Title (trang chủ)', 0, 1),
(5, 'description', 'Học trực tuyến cùng với những Giảng viên hàng đầu. Học online 24/7 - Tự tin làm chủ tương lai. Thư viện bài giảng trực tuyến | Trung tâm e-Learning.', 'Description (trang chủ)', 0, 2),
(6, 'keywords', 'Khóa học trực tuyến,khóa học,bài giảng,Trung tâm e-Learning,e-Learning', 'Keywords (trang chủ)', 0, 3),
(74, 'script_body', '', 'Script sau body', 4, 6),
(76, 'link_linkedin', '', 'LinkedIn', 5, 5),
(7, 'email_contact', 'huyto.qng@gmail.com', 'Email', 0, 8),
(8, 'tell_contact', '+84 974 779 085', 'Điện thoại', 0, 9),
(9, 'fulldate', 'D, d/m/Y', 'Kiểu hiển ngày đầy đủ', 3, 3),
(10, 'SMTP_username', 'olala.3w@gmail.com', 'Tài khoản email', 1, 0),
(11, 'SMTP_password', 'gmail@olala.3w', 'Mật khẩu email', 1, 0),
(12, 'error_page', '<p>Vì lý do kỹ&nbsp;thuật website tạm ngưng&nbsp;hoạt động. Thành thật xin lỗi các bạn&nbsp;vì sự bất tiện này!</p>\r\n', 'Thông báo ngừng hoạt động', 0, 19),
(13, 'file_logo', '/uploads/images/site/logo.png', 'Logo front-end', 0, 4),
(14, 'SMTP_secure', 'ssl', 'Sử dụng xác thực', 1, 0),
(15, 'SMTP_host', 'smtp.gmail.com', 'Máy chủ (SMTP) Thư gửi đi', 1, 0),
(16, 'SMTP_port', '465', 'Cổng gửi mail', 1, 0),
(17, 'backup_auto', '', 'Tự động sao lưu', 2, 0),
(18, 'backup_filetype', 'sql.gz', 'Định dạng lưu file CSDL', 2, 0),
(19, 'backup_filecount', '5', 'Số file CSDL lưu lại', 2, 0),
(20, 'backup_email', 'olala.3w@gmail.com', 'Email nhận thông báo và file', 2, 0),
(21, 'SMTP_mailname', 'Nguonnhadat.com.vn', 'Tên tài khoản email', 1, 0),
(22, 'link_facebook', 'https://www.facebook.com', 'Facebook', 5, 1),
(23, 'link_googleplus', 'https://plus.google.com', 'Google+', 5, 2),
(24, 'link_twitter', 'https://www.youtube.com', 'Twitter', 5, 3),
(25, 'address_contact', 'Đà Nẵng, Việt Nam', 'Địa chỉ', 0, 11),
(73, 'script_bottom', '', 'Script cuối trang', 4, 7),
(26, 'content_registertry', '', 'Email đăng ký học thử', 13, 17),
(27, 'author_google', '', 'ID profile Google+', 4, 1),
(28, 'google_analytics', '', 'Google analytics', 4, 4),
(29, 'chat_online', '', 'Script Chat Online', 4, 5),
(30, 'english_test', '', 'Kiểm tra tiếng Anh của bạn', 13, 18),
(31, 'google_calendar', '', 'Google Calendar (Account)', 4, 3),
(32, 'help_address', 'killlllme@gmail.com,0974.779.085,huy.to.bsn,mr.killlllme', 'Tư vấn - Địa chỉ', 13, 8),
(33, 'help_icon', 'fa-envelope-o,fa-phone,fa-skype,fa-facebook', 'Tư vấn - Icon', 13, 9),
(34, 'link_youtube', '', 'Youtube', 5, 4),
(35, 'search_destination', 'Hà Nội,Đà Nẵng,Hồ Chí Minh,Phú Quốc,Nha Trang,Hạ Long,Đà Lạt,Phong Nha Kẻ Bàng,Côn đảo Vũng Tàu,Thái Lan,Singapore,Malaysia,Campuchia,Trung Quốc,Nhật Bản,Hàn Quốc,Hà Lan,Myanmar,Úc,Hong Kong,Philippines,Indonesia,Đài Loan,Châu Á,Châu Âu,Châu Mỹ,Châu Phi,Châu Úc', 'Điểm đến (Tìm kiếm tour)', 13, 8),
(36, 'search_day', '1 Ngày,1 Ngày 1 Đêm,2 Ngày,2 Ngày 1 Đêm,3 Ngày,3 Ngày 2 Đêm,4 Ngày,4 Ngày 3 Đêm,5 Ngày,5 Ngày 4 Đêm,6 Ngày,6 Ngày 5 Đêm,7 Ngày,7 Ngày 6 Đêm,8 Ngày,8 Ngày 7 Đêm,9 Ngày,9 Ngày 8 Đêm,10 Ngày,10 Ngày 9 Đêm,11 Ngày,11 Ngày 10 Đêm,12 Ngày,12 Ngày 11 Đêm,1 Tuần,2 Tuần,3 Tuần,1 Tháng,2 Tháng,3 Tháng', 'Thời gian (Tìm kiếm tour)', 13, 9),
(75, 'fb_app_id', '', 'Facebook App ID', 4, 2),
(77, 'upload_img_max_w', '1900', 'Kích thước ảnh tối đa', 6, 1),
(78, 'upload_max_size', '2147483648', 'Dung lượng tối đa', 6, 2),
(79, 'upload_checking_mode', 'mild', 'Kiểu kiểm tra file tải lên', 6, 3),
(80, 'upload_type', '1,2,3,4,5,6,7,8,9,10,11', 'Loại files cho phép', 6, 4),
(81, 'upload_ext', '', 'Phần mở rộng bị cấm', 6, 5),
(82, 'upload_mime', '', 'Loại mime bị cấm', 6, 6),
(83, 'upload_img_max_h', '594', 'Kích thước ảnh tối đa', 6, 1),
(84, 'upload_auto_resize', '1', 'Tự động resize ảnh', 6, 1),
(85, 'article_author', '', 'Property = article:author', 4, 2),
(86, 'meta_author', 'e-Learning', 'Meta author', 0, 4),
(88, 'meta_site_name', 'Trung tâm học trực tuyến eLearning', 'Meta site name', 0, 5),
(89, 'meta_copyright', '© Copyright 2016 e-Learning', 'Meta copyright', 0, 6),
(90, 'image_thumbnailUrl', '/uploads/images/site/Nguon-nha-dat-Da-Nang.jpg', 'Image : thumbnailUrl', 0, 7),
(91, 'skype_contact', 'huyto.qng', 'Skype', 0, 10),
(92, 'link_instagram', '', 'Instagram', 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_contact`
--

CREATE TABLE IF NOT EXISTS `olala3w_contact` (
`contact_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `ip` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'fa-send-o',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `olala3w_contact`
--

INSERT INTO `olala3w_contact` (`contact_id`, `name`, `address`, `email`, `phone`, `content`, `is_active`, `ip`, `icon`, `created_time`, `modified_time`) VALUES
(1, '', '', '', '', '', 1, '', 'fa-send-o', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_core_privilege`
--

CREATE TABLE IF NOT EXISTS `olala3w_core_privilege` (
`privilege_id` bigint(20) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL,
  `privilege_slug` varchar(50) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4811 ;

--
-- Dumping data for table `olala3w_core_privilege`
--

INSERT INTO `olala3w_core_privilege` (`privilege_id`, `role_id`, `type`, `privilege_slug`) VALUES
(330, 2, 'core', 'core_mail'),
(3333, 1, 'core', 'core_dashboard'),
(3331, 1, 'core', 'core_role'),
(3332, 1, 'core', 'core_user'),
(3022, 12, 'core', 'core_role'),
(3023, 12, 'core', 'core_user'),
(3024, 12, 'core', 'core_dashboard'),
(3025, 12, 'core', 'core_mail'),
(3334, 1, 'core', 'core_mail'),
(4810, 1, 'info', 'sys_info_expansion'),
(4809, 1, 'info', 'sys_info_php'),
(4808, 1, 'info', 'sys_info_site'),
(4807, 1, 'info', 'sys_info_diary'),
(4806, 1, 'tool', 'tool_update'),
(4805, 1, 'tool', 'tool_ipdie'),
(4804, 1, 'tool', 'tool_keywords'),
(4803, 1, 'tool', 'tool_site'),
(4802, 1, 'tool', 'tool_delete'),
(4801, 1, 'config', 'config_upload'),
(4800, 1, 'config', 'config_search'),
(4799, 1, 'config', 'config_socialnetwork'),
(4798, 1, 'config', 'config_plugins'),
(4797, 1, 'config', 'config_datetime'),
(4796, 1, 'config', 'config_smtp'),
(4795, 1, 'config', 'config_general'),
(4794, 1, 'backup', 'backup_config'),
(4793, 1, 'backup', 'backup_data'),
(4792, 1, 'pages', 'plugin_page_del'),
(4791, 1, 'pages', 'plugin_page_edit'),
(4790, 1, 'pages', 'plugin_page_add'),
(4789, 1, 'forum', 'forum_del;96'),
(4788, 1, 'forum', 'forum_edit;96'),
(4787, 1, 'forum', 'forum_add;96'),
(4753, 1, 'article', 'article_menu_del;90'),
(4786, 1, 'forum', 'forum_list;96'),
(4785, 1, 'forum', 'forum_menu_del;96'),
(4784, 1, 'forum', 'forum_menu_edit;96'),
(4783, 1, 'forum', 'forum_menu_add;96'),
(4782, 1, 'forum', 'category_edit;96'),
(4781, 1, 'product', 'product_del;89'),
(4780, 1, 'product', 'product_edit;89'),
(4779, 1, 'product', 'product_add;89'),
(4778, 1, 'product', 'product_list;89'),
(4777, 1, 'product', 'product_menu_del;89'),
(4776, 1, 'product', 'product_menu_edit;89'),
(4775, 1, 'product', 'product_menu_add;89'),
(4774, 1, 'product', 'category_edit;89'),
(4773, 1, 'gallery', 'gallery_del;91'),
(4772, 1, 'gallery', 'gallery_edit;91'),
(4771, 1, 'gallery', 'gallery_add;91'),
(4770, 1, 'gallery', 'gallery_list;91'),
(4769, 1, 'gallery', 'gallery_menu_del;91'),
(4768, 1, 'gallery', 'gallery_menu_edit;91'),
(4767, 1, 'gallery', 'gallery_menu_add;91'),
(4766, 1, 'gallery', 'category_edit;91'),
(4765, 1, 'article', 'article_del;95'),
(4764, 1, 'article', 'article_edit;95'),
(4763, 1, 'article', 'article_add;95'),
(4762, 1, 'article', 'article_list;95'),
(4761, 1, 'article', 'article_menu_del;95'),
(4760, 1, 'article', 'article_menu_edit;95'),
(4759, 1, 'article', 'article_menu_add;95'),
(4758, 1, 'article', 'category_edit;95'),
(4757, 1, 'article', 'article_del;90'),
(4756, 1, 'article', 'article_edit;90'),
(4755, 1, 'article', 'article_add;90'),
(4754, 1, 'article', 'article_list;90'),
(4752, 1, 'article', 'article_menu_edit;90'),
(4751, 1, 'article', 'article_menu_add;90'),
(4749, 1, 'article', 'article_del;94'),
(4750, 1, 'article', 'category_edit;90'),
(4748, 1, 'article', 'article_edit;94'),
(4746, 1, 'article', 'article_list;94'),
(4747, 1, 'article', 'article_add;94'),
(4745, 1, 'article', 'article_menu_del;94'),
(4744, 1, 'article', 'article_menu_edit;94'),
(4743, 1, 'article', 'article_menu_add;94'),
(4742, 1, 'article', 'category_edit;94'),
(4741, 1, 'category', 'plugin_page'),
(4740, 1, 'category', 'contact_list'),
(4739, 1, 'category', 'others_manager'),
(4738, 1, 'category', 'forum_manager'),
(4737, 1, 'category', 'product_manager'),
(4736, 1, 'category', 'gallery_manager'),
(4735, 1, 'category', 'article_manager');

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_core_role`
--

CREATE TABLE IF NOT EXISTS `olala3w_core_role` (
`role_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `olala3w_core_role`
--

INSERT INTO `olala3w_core_role` (`role_id`, `name`, `comment`, `is_active`, `modified_time`, `user_id`) VALUES
(1, 'Administrator', 'Nhóm quản trị tối cao', 1, 1441786254, 1),
(2, 'Tester', 'Nhóm kiểm thử', 1, 1441851198, 1),
(9, 'Broker', 'Nhân viên môi giới. Chỉ nhập và quản lý thông tin BĐS.', 1, 1439055844, 1),
(13, 'Students', 'Tài khoản dành cho học viên.', 0, 1476461700, 1);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_core_user`
--

CREATE TABLE IF NOT EXISTS `olala3w_core_user` (
`user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_name` varchar(16) NOT NULL,
  `password` varchar(50) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `gender` int(1) NOT NULL DEFAULT '0',
  `birthday` int(11) NOT NULL DEFAULT '0',
  `apply` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `is_show` int(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `vote` bigint(20) NOT NULL DEFAULT '1',
  `click_vote` bigint(20) NOT NULL DEFAULT '1',
  `b_notify1` int(1) NOT NULL DEFAULT '1',
  `b_notify2` int(1) NOT NULL DEFAULT '1',
  `b_notify3` int(1) NOT NULL DEFAULT '1',
  `b_notify4` int(1) DEFAULT '1',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id_edit` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `olala3w_core_user`
--

INSERT INTO `olala3w_core_user` (`user_id`, `role_id`, `user_name`, `password`, `full_name`, `gender`, `birthday`, `apply`, `email`, `phone`, `address`, `comment`, `is_show`, `sort`, `img`, `is_active`, `vote`, `click_vote`, `b_notify1`, `b_notify2`, `b_notify3`, `b_notify4`, `created_time`, `modified_time`, `user_id_edit`) VALUES
(1, 1, 'admin', 'ca4c0178da5c3219c4150c77b16c935d', 'Administrator', 1, 694198800, 'Quản trị Website', 'huyto.qng@gmail.com', '0974779085', 'Đà Nẵng', 'Hello...', 1, 2, 'u_1479652434_3d08109ba2d35db07b00f8f92abb52d9.jpg', 1, 1, 1, 1, 1, 1, 1, 1408159832, 1483470352, 1),
(25, 1, 'dev', '35622d129658338262443a22a9c7bac5', 'Tô Thái Huy', 1, 0, '', 'huyto.qng@gmail.com', '0974779805', '', '', 1, 1, 'u_1437075987_ffbbbf570157f5aa239cf98d7caa354a.jpg', 1, 1, 1, 1, 1, 1, 1, 0, 1483469983, 1),
(27, 13, 'admin123', 'c466f189d277fc0e6702ec3fe5ea18d7', 'Tô Thái Huy', 0, 0, '', 'killlllme@gmail.vn', '0974779086', '', '', 0, 1, 'no', 1, 1, 1, 1, 1, 1, 1, 1483470674, 1483472506, 0),
(28, 13, 'abc1234', 'db8359616fdef167cecafb8e91ca39f5', 'Tô Thái Huy', 0, 0, '', '', '0974778095', '', '', 0, 1, 'no', 1, 1, 1, 1, 1, 1, 1, 1484069444, 0, 0),
(29, 13, 'abc1235', 'bfc583c544505e63c9007ddfb752f5e5', 'Thái Huy', 0, 0, '', '', '09292413000', '', '', 0, 1, 'no', 1, 1, 1, 1, 1, 1, 1, 1484069533, 0, 0),
(30, 13, 'abc1236', '9f5e1d648b0c987248239012ce17a630', 'Huy Tô', 0, 0, '', '', '090004444', '', '', 0, 1, 'no', 1, 1, 1, 1, 1, 1, 1, 1484069763, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_courses`
--

CREATE TABLE IF NOT EXISTS `olala3w_courses` (
`courses_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `v_folder` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL DEFAULT '-no-',
  `video_playtime` varchar(20) NOT NULL,
  `video_size` double NOT NULL DEFAULT '0',
  `d_folder` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL DEFAULT '-no-',
  `document_title` varchar(255) NOT NULL,
  `document_size` double NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `test` int(11) NOT NULL DEFAULT '0',
  `practice` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `olala3w_courses`
--

INSERT INTO `olala3w_courses` (`courses_id`, `product_id`, `name`, `v_folder`, `video`, `video_playtime`, `video_size`, `d_folder`, `document`, `document_title`, `document_size`, `content`, `test`, `practice`, `sort`, `is_active`, `hot`, `views`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(4, 3, 'Cách mở, lưu 1 tập tin trong Photoshop', 'admin\\11-2016\\', 'Video_cach-mo-luu-1-tap-tin-trong-photoshop_1.mp4', '1:35:01', 348321935, 'admin\\11-2016\\', 'Document_tai-lieu-photoshop.docx', 'Tài liệu photoshop', 4708033, '', 0, '', 2, 1, 0, 1, 1477317180, 1, 1480263394, 1),
(3, 3, 'Giới thiệu Photoshop CC', '', 'Video_47b9c385224a6b34b2bf1f87afa31c50.mp4', '11:45', 61350594, '', 'Document_9a464a7f0f1a4c11b3ced390d9b319a9.pdf', 'Thử tên tài liệu...', 671337, '<p>Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. The…Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. Theo nhà sư, việc mất 3 con chim xảy ra ngày 22/8, chùa có báo với Công an huyện Long Hồ (Vĩnh Long) nhưng chưa tìm được. 3 con khổng tước có giá trị khoảng 60 triệu đồng, được nuôi khá lâu trong khuôn viên chùa. Chúng được nhốt trong chuồng làm bằng lưới, có hàng rào bao bọc, đêm khóa cửa cẩn thận nhưng vẫn bị mất. Nhiều sư sãi trong chùa rất buồn vì 3 chú chim quý bầu bạn lâu nay bị lấy trộm nên ra sức tìm kiếm. "Nghe tin nó xuất hiện ở Sài Gòn, xem hình thấy rất giống nên chùa cử tôi nên xác minh. Vừa nhìn thấy là biết nó rồi nên tôi rất mừng", nhà sư bày tỏ. Đại diện Thảo Cầm Viên đã hướng dẫn nhà sư quay trở về địa phương xác minh một số giấy tờ rồi lên làm thủ tục nhận chim.Chiều 27/10, một nhà sư ở chùa Sơn An (huyện Long Hồ, Vĩnh Long) đến Thảo Cầm Viên Sài Gòn xin nhận lại con khổng tước vừa được đơn vị này bắt trước đó một ngày. Sau hồi quan sát, nhà sư khẳng định đây là một trong 3 con công mà chùa bị mất trộm. The…</p>\r\n', 2, 'http://vnexpress.net/', 1, 1, 0, 1, 1477271820, 1, 1484258091, 1),
(16, 3, 'Demo', 'admin\\11-2016\\', 'Video_demo.mp4', '1:28:18', 387257901, 'admin\\11-2016\\', '-no-', '', 0, '', 0, '', 3, 1, 0, 1, 1480407987, 1, 1480407987, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_courses_logs`
--

CREATE TABLE IF NOT EXISTS `olala3w_courses_logs` (
`courses_logs_id` double NOT NULL,
  `courses_id` int(11) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `olala3w_courses_logs`
--

INSERT INTO `olala3w_courses_logs` (`courses_logs_id`, `courses_id`, `created_time`, `modified_time`, `user_id`) VALUES
(11, 3, 1477627807, 1484258615, 1),
(12, 4, 1477627830, 1482255447, 1),
(13, 16, 1480408000, 1482441604, 1);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_direction`
--

CREATE TABLE IF NOT EXISTS `olala3w_direction` (
`direction_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_discussion`
--

CREATE TABLE IF NOT EXISTS `olala3w_discussion` (
`discussion_id` double NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `courses_id` int(11) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `parent` double NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `olala3w_discussion`
--

INSERT INTO `olala3w_discussion` (`discussion_id`, `product_id`, `courses_id`, `content`, `parent`, `is_active`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(1, 3, 0, 'Thử nghiệm ... 123 ...', 0, 1, 1483381101, 1, 0, 0),
(2, 3, 3, 'Thử nghiệm ... 123 ...', 0, 1, 1483381110, 1, 0, 0),
(3, 3, 3, 'Thử nghiệm ... 123 ...', 0, 1, 1483381112, 1, 0, 0),
(4, 3, 3, 'Thử nghiệm ... 123 ...', 0, 1, 1483381114, 1, 0, 0),
(5, 3, 3, 'Thử nghiệm ... (123) ...', 4, 1, 1483381242, 1, 0, 0),
(6, 3, 3, 'Thử nghiệm ... (123) ...', 4, 1, 1483381243, 1, 0, 0),
(7, 3, 3, 'Thử nghiệm ... (123) ...', 4, 1, 1483381245, 1, 0, 0),
(8, 3, 3, 'Thử nghiệm ... (123) ...', 4, 1, 1483381248, 1, 0, 0),
(9, 3, 3, 'Thử nghiệm ... (123) ...', 4, 1, 1483381250, 1, 0, 0),
(10, 3, 0, 'Abc', 0, 1, 1483556081, 1, 0, 0),
(11, 3, 0, 'XX', 0, 1, 1483561165, 1, 0, 0),
(12, 3, 0, 'XX', 11, 1, 1483561176, 1, 0, 0),
(13, 3, 0, 'Hello...', 0, 1, 1483561338, 1, 0, 0),
(14, 3, 0, '123 xin chào!...', 0, 1, 1483561424, 1, 0, 0),
(15, 3, 0, 'Chào...', 14, 1, 1483561502, 1, 0, 0),
(16, 3, 0, 'Hello\n', 14, 1, 1484253802, 25, 0, 0),
(17, 3, 0, 'adad', 14, 1, 1484253962, 25, 0, 0),
(18, 3, 0, 'adadqeq', 0, 1, 1484253965, 25, 0, 0),
(19, 3, 0, '123', 18, 1, 1484253970, 25, 0, 0),
(20, 3, 0, 'axa', 18, 1, 1484253973, 25, 0, 0),
(21, 3, 0, 'adad', 18, 1, 1484253976, 25, 0, 0),
(22, 3, 0, 'a', 0, 1, 1484255818, 25, 0, 0),
(23, 3, 0, 'a', 0, 1, 1484257299, 25, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_document`
--

CREATE TABLE IF NOT EXISTS `olala3w_document` (
`document_id` int(11) NOT NULL,
  `document_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `release_date` int(11) NOT NULL DEFAULT '0',
  `effective_date` int(11) NOT NULL DEFAULT '0',
  `file` varchar(255) NOT NULL DEFAULT 'no',
  `type` varchar(5) NOT NULL DEFAULT 'unk',
  `size` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `content` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_document_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_document_menu` (
`document_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT 'not-found',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `comment` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_forum`
--

CREATE TABLE IF NOT EXISTS `olala3w_forum` (
`forum_id` int(11) NOT NULL,
  `forum_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `content` longtext NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `c_like` bigint(20) NOT NULL DEFAULT '0',
  `c_comment` bigint(20) NOT NULL,
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=216 ;

--
-- Dumping data for table `olala3w_forum`
--

INSERT INTO `olala3w_forum` (`forum_id`, `forum_menu_id`, `name`, `title`, `description`, `keywords`, `content`, `is_active`, `hot`, `views`, `c_like`, `c_comment`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(211, 217, 'Kiểm thử kết quả mới nhất 102 ...', '', '', '', '', 1, 0, 9, 0, 1, 1481171789, 1, 1482093709, 1),
(212, 217, 'Kiểm thử kết quả mới nhất 103 ...', '', '', '', '', 1, 0, 3, 0, 3, 1481072037, 1, 0, 0),
(214, 217, 'Trump nói Trung Quốc cứ giữ lấy thiết bị lặn của Mỹ EDIT 123', '', '', '', '<p>"Chúng ta nên nói với Trung Quốc rằng ta không cần thiết bị lặn không người lái mà họ lấy nữa. Cứ để họ giữ chúng", NBC News dẫn lời tổng thống đắc cử Mỹ Donald Trump viết.</p>\n\n<p style="text-align: center; "><img src="/uploads/forum/admin/12-2016/104466114-Donald-Trump-OPINION-6287-7287-1482064261_1482090516.jpg" style="" /></p>\n\n<p style="text-align: center; "><i>Tổng thống đắc cử Mỹ Donald Trump. Ảnh: AP</i></p>\n\n<p>"Chúng ta nên nói với Trung Quốc rằng ta không cần thiết bị lặn không người lái mà họ lấy nữa. Cứ để họ giữ chúng", NBC News dẫn lời tổng thống đắc cử Mỹ Donald Trump viết.</p>\n\n<p>Nhà tài phiệt New York đưa ra bình luận trên sau khi Bộ Quốc phòng Trung Quốc hôm qua ngỏ ý muốn trả lại thiết bị lặn của Mỹ mà họ thu giữ trên Biển Đông cách đây ba ngày, đồng thời Lầu Năm Góc cũng cho biết đã đạt được thỏa thuận với phía Trung Quốc.</p>\n\n<p>Trước đó, ông Trump cáo buộc Trung Quốc "đánh cắp" thiết bị nghiên cứu của hải quân Mỹ trên vùng biển quốc tế và gọi đây là hành động "chưa từng có tiền lệ".</p>\n\n<p>Thiết bị lặn Seaglide chuyên nghiên cứu hải dương thuộc biên chế hải quân Mỹ bị một tàu chiến Trung Quốc thu giữ ở vùng biển cách vịnh Subic, Philippines, khoảng 92 km về phía tây bắc, theo thông báo từ Lầu Năm Góc.</p>\n\n<p>Nhiều chuyên gia phân tích nhận định động thái trên như một tín hiệu thách thức mà Bắc Kinh muốn gửi tới ông Trump, đặc biệt trong bối cảnh tổng thống đắc cử Mỹ vừa có cuộc điện đàm phá vỡ các nguyên tắc ngoại giao với nhà lãnh đạo Đài Loan Thái Anh Văn.</p>\n', 1, 0, 21353, 2, 16, 1482090650, 1, 1483561794, 1);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_forum_comment`
--

CREATE TABLE IF NOT EXISTS `olala3w_forum_comment` (
`forum_comment_id` bigint(20) NOT NULL,
  `forum_id` int(11) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `c_like` bigint(20) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `olala3w_forum_comment`
--

INSERT INTO `olala3w_forum_comment` (`forum_comment_id`, `forum_id`, `content`, `c_like`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(1, 214, 'Chỉnh sửa mới...', 0, 1482427436, 1, 1483375864, 1),
(2, 214, '<p style="color: rgb(30, 31, 31); text-align: justify;">Thiết bị lặn Seaglide chuyên nghiên cứu hải dương thuộc biên chế hải quân Mỹ bị một tàu chiến Trung Quốc thu giữ ở vùng biển cách vịnh Subic, Philippines, khoảng 92 km về phía tây bắc, theo thông báo từ Lầu Năm Góc.</p><p style="color: rgb(30, 31, 31); text-align: justify;">Nhiều chuyên gia phân tích nhận định động thái trên như một tín hiệu thách thức mà Bắc Kinh muốn gửi tới ông Trump, đặc biệt trong bối cảnh tổng thống đắc cử Mỹ vừa có cuộc điện đàm phá vỡ các nguyên tắc ngoại giao với nhà lãnh đạo Đài Loan Thái Anh Văn.</p>', 0, 1482427755, 1, 0, 0),
(21, 214, '<pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">function</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> removeElementsByClass</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">className</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">){</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n    </span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">var</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> elements </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> document</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">getElementsByClassName</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">className</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n    </span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">while</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">elements</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">length </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="lit" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">0</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">){</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n        elements</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="lit" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">0</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">].</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">parentNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">removeChild</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">elements</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="lit" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">0</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">]);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n    </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">}</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">}</span></code></pre>', 0, 1483376640, 1, 0, 0),
(23, 214, '<pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">var</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> col_wrapper </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> document</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">getElementById</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">"columns"</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">).</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">getElementsByTagName</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">"div"</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n\n</span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">var</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> elementsToRemove </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[];</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n</span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">for</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">var</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> i </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="lit" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">0</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> i </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">&lt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> col_wrapper</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">length</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> i</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">++)</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">{</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n    </span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">if</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">col_wrapper</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">i</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">].</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">className</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">toLowerCase</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">()</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">==</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">"column"</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">)</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">{</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n        elementsToRemove</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">push</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">col_wrapper</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">i</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">]);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n    </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">}</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">}</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n</span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">for</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">var</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> i </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="lit" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">0</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> i </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">&lt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> elementsToRemove</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">length</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> i</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">++)</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">{</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n    elementsToRemove</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">i</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">].</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">parentNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">removeChild</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">elementsToRemove</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">i</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">]);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">}</span></code></pre>', 0, 1483376658, 1, 0, 0),
(24, 214, '<p style="margin-bottom: 1em; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">If you prefer not to use JQuery:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">function</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> removeElementsByClass</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">className</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">){</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n    </span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">var</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> elements </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> document</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">getElementsByClassName</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">className</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n    </span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">while</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">elements</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">length </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="lit" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">0</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">){</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n        elements</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="lit" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">0</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">].</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">parentNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">removeChild</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">elements</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="lit" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">0</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">]);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n    </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">}</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">}</span></code></pre>', 0, 1483377250, 1, 0, 0),
(26, 214, '<p style="margin-bottom: 1em; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">Using&nbsp;<strong style="margin-right: 0px; margin-left: 0px; border: 0px;">ES6</strong>&nbsp;you could do like:</p><p style="margin-bottom: 1em; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;"></p><div class="snippet" data-lang="js" data-hide="false" data-console="true" data-babel="false" style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 15px; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;"><div class="snippet-code" style="margin-right: 0px; margin-left: 0px; padding: 10px; border: 1px solid rgb(228, 230, 232);"><pre class="snippet-code-js lang-js prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">let</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> removeElements </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> elms </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="typ" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(43, 145, 175);">Array</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">from</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">elms</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">).</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">forEach</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">el </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> el</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">remove</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">());</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n\n</span><span class="com" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(133, 140, 147);">// Use like:</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\nremoveElements</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> document</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">querySelectorAll</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">"#parent .p1"</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">)</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span></code></pre><pre class="snippet-code-html lang-html prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&lt;div</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="atn" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(230, 67, 32);">id</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="atv" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(15, 116, 189);">parent</span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n  </span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&lt;p</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="atn" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(230, 67, 32);">class</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="atv" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(15, 116, 189);">"p1"</span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">P 1</span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&lt;/p&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n  </span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&lt;p</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="atn" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(230, 67, 32);">class</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="atv" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(15, 116, 189);">"p2"</span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">P 2</span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&lt;/p&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n  </span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&lt;p</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="atn" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(230, 67, 32);">class</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="atv" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(15, 116, 189);">"p1"</span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">P 1</span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&lt;/p&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n</span><span class="tag" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">&lt;/div&gt;</span></code></pre></div></div>', 0, 1483377269, 1, 0, 0),
(27, 214, '<div><br></div><div><table style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; background-color: rgb(255, 255, 255);"><tbody style="margin-right: 0px; margin-left: 0px; border: 0px;"><tr style="margin-right: 0px; margin-left: 0px; border: 0px;"><td class="votecell" style="margin-right: 0px; margin-left: 0px; padding-right: 15px; border: 0px; vertical-align: top;"><div class="vote" style="margin-right: 0px; margin-left: 0px; border: 0px; text-align: center; min-width: 46px;"><span itemprop="upvoteCount" class="vote-count-post " style="margin: 8px 0px; border: 0px; font-size: 20px; display: block; color: rgb(106, 115, 124);">1</span><a class="vote-down-off" title="This answer is not useful" style="margin-bottom: 10px; border: 0px; font-size: 1px; color: rgb(0, 119, 204); cursor: pointer; background-image: url(&quot;img/sprites.svg?v=8c1c8cba242e&quot;), none; background-size: initial; background-repeat: no-repeat; overflow: hidden; display: block; text-indent: -9999em; width: 40px; height: 30px; background-position: 0px -220px;">down vote</a></div></td><td class="answercell" style="margin-right: 0px; margin-left: 0px; border: 0px; vertical-align: top;"><div class="post-text" itemprop="text" style="margin-right: 0px; margin-bottom: 5px; margin-left: 0px; border: 0px; font-size: 15px; width: 660px; word-wrap: break-word; line-height: 1.3;"><p style="margin-bottom: 1em; border: 0px; clear: both;">Yes, you have to remove from the parent:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">cur_columns</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">i</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">].</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">parentNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">removeChild</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">cur_columns</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">i</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">]);</span></code></pre></div><table class="fw" style="margin-right: 0px; margin-bottom: 4px; margin-left: 0px; border: 0px; font-size: 13px; width: 660px;"><tbody style="margin-right: 0px; margin-left: 0px; border: 0px;"><tr style="margin-right: 0px; margin-left: 0px; border: 0px;"><td class="vt" style="margin-right: 0px; margin-left: 0px; border: 0px; vertical-align: top;"><div class="post-menu" style="margin-right: 0px; margin-left: 0px; padding-top: 2px; border: 0px;"><a href="http://stackoverflow.com/a/4777101" title="short permalink to this answer" class="short-link" id="link-post-4777101" style="margin-right: 0px; margin-left: 0px; padding-right: 3px; padding-bottom: 2px; padding-left: 3px; border: 0px; color: rgb(132, 141, 149); cursor: pointer; display: inline-block;">share</a><span class="lsep" style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 1px; color: rgb(27, 64, 114); visibility: hidden; display: inline-block;"></span><a href="http://stackoverflow.com/posts/4777101/edit" class="suggest-edit-post" title="" style="margin-right: 0px; margin-left: 0px; padding-right: 3px; padding-bottom: 2px; padding-left: 3px; border: 0px; color: rgb(132, 141, 149); cursor: pointer; display: inline-block;">improve this answer</a></div></td></tr></tbody></table></td></tr></tbody></table></div>', 0, 1483377281, 1, 0, 0),
(38, 214, '<p style="margin-bottom: 1em; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">The simplest solution would be, in my opinion:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">const</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> elements </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> document</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">getElementsByClassName</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">"my-class"</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n\n</span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">while</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">elements</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">length </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">&gt;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="lit" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">0</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">)</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">{</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n    elements</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="lit" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">0</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">].</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">remove</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">();</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">}</span></code></pre>', 0, 1483377729, 1, 0, 0),
(39, 214, '<p style="margin-bottom: 1em; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">You can you use a simple solution, just change the class, the HTML Collection filter is updated:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">var</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> cur_columns </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> document</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">getElementsByClassName</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">''column''</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n\n</span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">for</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">i </span><span class="kwd" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(16, 16, 148);">in</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> cur_columns</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">)</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">{</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n   cur_columns</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">[</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">i</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">].</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">className </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">''''</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">;</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\n</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">}</span></code></pre>', 0, 1483377736, 1, 0, 0);
INSERT INTO `olala3w_forum_comment` (`forum_comment_id`, `forum_id`, `content`, `c_like`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(40, 214, '<p style="margin-bottom: 1em; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">ou can use this syntax:&nbsp;<code style="margin-right: 0px; margin-left: 0px; padding: 1px 5px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: pre-wrap;">node.parentNode</code></p><p style="margin-bottom: 1em; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">For example:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">someNode </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> document</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">getElementById</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">"someId"</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\nsomeNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">parentNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">removeChild</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">someNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span></code></pre>', 0, 1483377750, 1, 0, 0),
(42, 214, 'ada<span style="color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 15px;">ou can use this syntax:</span><span style="color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 15px;">&nbsp;</span><code style="margin-right: 0px; margin-left: 0px; padding: 1px 5px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: pre-wrap;">node.parentNode</code><p style="margin-bottom: 1em; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">For example:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">someNode </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> document</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">getElementById</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">"someId"</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\nsomeNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">parentNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">removeChild</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">someNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span></code></pre>', 0, 1483377754, 1, 0, 0),
(43, 214, 'aq4q4<span style="color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 15px;">ou can use this syntax:</span><span style="color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 15px;">&nbsp;</span><code style="margin-right: 0px; margin-left: 0px; padding: 1px 5px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: pre-wrap;">node.parentNode</code><p style="margin-bottom: 1em; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">For example:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">someNode </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> document</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">getElementById</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">"someId"</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\nsomeNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">parentNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">removeChild</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">someNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span></code></pre>', 0, 1483377757, 1, 0, 0),
(44, 214, '<p>dE&nbsp; &nbsp; E<span style="color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 15px;">ou can use this syntax:</span><span style="color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 15px;">&nbsp;</span><code style="margin-right: 0px; margin-left: 0px; padding: 1px 5px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: pre-wrap;">node.parentNode</code></p><p style="margin-bottom: 1em; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">For example:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin-right: 0px; margin-left: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">someNode </span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);"> document</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">getElementById</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(125, 39, 39);">"someId"</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">\nsomeNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">parentNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">.</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">removeChild</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="pln" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">someNode</span><span class="pun" style="margin-right: 0px; margin-left: 0px; border: 0px; color: rgb(48, 51, 54);">);</span></code></pre>', 0, 1483377761, 1, 0, 0),
(48, 214, '<h2 class="hd" style="position: absolute; width: 1px; height: 1px; top: -1000em; overflow: hidden; color: rgb(34, 34, 34); font-family: arial, sans-serif;">Kết quả tìm kiếm</h2><div data-async-context="query:js%20add%20html%20to%20last%20element" id="ires" style="margin-top: 6px; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: medium;"><div eid="tYxqWOvTPMeMvQSjtaGYAQ" id="rso"><div class="_NId"><div class="srg"><div class="g" style="line-height: 1.2; font-size: small; margin-bottom: 26px;"><div class="rc" data-hveid="22" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQFQgWKAAwAA" style="position: relative;"><h3 class="r" style="font-size: 18px; margin: 0px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><a href="http://www.w3schools.com/jsref/prop_node_lastchild.asp" style="color: rgb(102, 0, 153); cursor: pointer;">HTML DOM Node lastChild Property - W3Schools</a></h3><div class="s" style="max-width: 48em; color: rgb(84, 84, 84); line-height: 18px;"><div class="f kv _SWb" style="color: rgb(128, 128, 128); height: 18px; line-height: 16px; white-space: nowrap;"><cite class="_Rm" style="color: rgb(0, 102, 33); font-style: normal; font-size: 14px;">www.w3schools.com/jsref/prop_node_<b>last</b>child.asp</cite><div class="action-menu ab_ctl" style="display: inline; position: relative; margin-top: 1px; margin-right: 3px; margin-left: 3px; user-select: none; vertical-align: middle;"><a class="_Fmb ab_button" href="https://www.google.com.vn/?gws_rd=ssl#" id="am-b0" aria-label="Chi tiết về kết quả tìm kiếm" aria-expanded="false" aria-haspopup="true" role="button" jsaction="m.tdd;keydown:m.hbke;keypress:m.mskpe" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQ7B0IGDAA" style="border-radius: 0px; cursor: default; font-size: 11px; font-weight: bold; height: 12px; line-height: 27px; margin: 1px 0px 2px; min-width: 0px; text-align: center; transition: none; user-select: none; background-color: white; background-image: none; border: 0px; color: rgb(128, 128, 128); box-shadow: 0px 0px 0px 0px; filter: none; width: 13px; display: inline-block;"><span class="mn-dwn-arw" style="border-color: rgb(0, 102, 33) transparent; border-style: solid; border-width: 5px 4px 0px !important; width: 0px; height: 0px; margin-left: 3px; top: 7.5px; margin-top: -4px; position: absolute; left: 0px;"></span></a><div class="action-menu-panel ab_dropdown" role="menu" tabindex="-1" jsaction="keydown:m.hdke;mouseover:m.hdhne;mouseout:m.hdhue" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQqR8IGTAA" style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 1px solid rgba(0, 0, 0, 0.2); font-size: 13px; position: absolute; right: auto; top: 12px; z-index: 3; transition: opacity 0.218s; box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 4px; left: 0px; visibility: hidden;"><ol style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px; border: 0px;"><li class="action-menu-item ab_dropdownitem" role="menuitem" style="margin-right: 0px; margin-left: 0px; border: 0px; list-style: none; user-select: none; cursor: pointer;"><a class="fl" href="http://webcache.googleusercontent.com/search?q=cache:7UPBXRro8ecJ:www.w3schools.com/jsref/prop_node_lastchild.asp+&amp;cd=1&amp;hl=vi&amp;ct=clnk&amp;gl=vn" style="color: rgb(51, 51, 51); cursor: pointer; display: block; padding: 7px 18px; outline: 0px; font-size: 14px;"></a></li><li class="action-menu-item ab_dropdownitem" role="menuitem" style="margin-right: 0px; margin-left: 0px; border: 0px; list-style: none; user-select: none; cursor: pointer;"><a class="fl" href="https://www.google.com.vn/search?biw=1366&amp;bih=638&amp;q=related:www.w3schools.com/jsref/prop_node_lastchild.asp+js+add+html+to+last+element&amp;tbo=1&amp;sa=X&amp;ved=0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQHwgbMAA" style="color: rgb(51, 51, 51); cursor: pointer; display: block; padding: 7px 18px; outline: 0px; font-size: 14px;"></a></li></ol></div></div><a class="fl" href="https://translate.google.com.vn/translate?hl=vi&amp;sl=en&amp;u=http://www.w3schools.com/jsref/prop_node_lastchild.asp&amp;prev=search" style="color: rgb(26, 13, 171); cursor: pointer; font-size: 14px;">Dịch trang này</a></div><span class="st" style="line-height: 1.4; word-wrap: break-word;">The difference between this property and lastElementChild, is that lastChild returns the&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">last</span>&nbsp;child node as an&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">element</span>&nbsp;node, a text node or a comment node&nbsp;...</span></div></div></div><div class="g" style="line-height: 1.2; font-size: small; margin-bottom: 26px;"><div class="rc" data-hveid="30" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQFQgeKAEwAQ" style="position: relative;"><h3 class="r" style="font-size: 18px; margin: 0px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><a href="https://www.google.com.vn/url?sa=t&amp;rct=j&amp;q=&amp;esrc=s&amp;source=web&amp;cd=2&amp;cad=rja&amp;uact=8&amp;ved=0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQFggfMAE&amp;url=http%3A%2F%2Fapi.jquery.com%2Fappend%2F&amp;usg=AFQjCNHOUufNEqoLDGnYJCokTxkU1HnY3w&amp;sig2=5Ii4SDVz4Iz7dFrV5fjGJg&amp;bvm=bv.142059868,d.c2I" data-href="http://api.jquery.com/append/" style="color: rgb(102, 0, 153); cursor: pointer;">.append() | jQuery API Documentation</a></h3><div class="s" style="max-width: 48em; color: rgb(84, 84, 84); line-height: 18px;"><div class="f kv _SWb" style="color: rgb(128, 128, 128); height: 18px; line-height: 16px; white-space: nowrap;"><cite class="_Rm bc" style="color: rgb(0, 102, 33); font-style: normal; font-size: 14px;">api.jquery.com › Manipulation › DOM Insertion, Inside</cite><div class="action-menu ab_ctl" style="display: inline; position: relative; margin-top: 1px; margin-right: 3px; margin-left: 3px; user-select: none; vertical-align: middle;"><a class="_Fmb ab_button" href="https://www.google.com.vn/?gws_rd=ssl#" id="am-b1" aria-label="Chi tiết về kết quả tìm kiếm" aria-expanded="false" aria-haspopup="true" role="button" jsaction="m.tdd;keydown:m.hbke;keypress:m.mskpe" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQ7B0IITAB" style="border-radius: 0px; cursor: default; font-size: 11px; font-weight: bold; height: 12px; line-height: 27px; margin: 1px 0px 2px; min-width: 0px; text-align: center; transition: none; user-select: none; background-color: white; background-image: none; border: 0px; color: rgb(128, 128, 128); box-shadow: 0px 0px 0px 0px; filter: none; width: 13px; display: inline-block;"><span class="mn-dwn-arw" style="border-color: rgb(0, 102, 33) transparent; border-style: solid; border-width: 5px 4px 0px !important; width: 0px; height: 0px; margin-left: 3px; top: 7.5px; margin-top: -4px; position: absolute; left: 0px;"></span></a><div class="action-menu-panel ab_dropdown" role="menu" tabindex="-1" jsaction="keydown:m.hdke;mouseover:m.hdhne;mouseout:m.hdhue" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQqR8IIjAB" style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 1px solid rgba(0, 0, 0, 0.2); font-size: 13px; position: absolute; right: auto; top: 12px; z-index: 3; transition: opacity 0.218s; box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 4px; left: 0px; visibility: hidden;"><ol style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px; border: 0px;"><li class="action-menu-item ab_dropdownitem" role="menuitem" style="margin-right: 0px; margin-left: 0px; border: 0px; list-style: none; user-select: none; cursor: pointer;"><a class="fl" href="http://webcache.googleusercontent.com/search?q=cache:9wRXx0H0IHoJ:api.jquery.com/append/+&amp;cd=2&amp;hl=vi&amp;ct=clnk&amp;gl=vn" style="color: rgb(51, 51, 51); cursor: pointer; display: block; padding: 7px 18px; outline: 0px; font-size: 14px;"></a></li><li class="action-menu-item ab_dropdownitem" role="menuitem" style="margin-right: 0px; margin-left: 0px; border: 0px; list-style: none; user-select: none; cursor: pointer;"><a class="fl" href="https://www.google.com.vn/search?biw=1366&amp;bih=638&amp;q=related:api.jquery.com/append/+js+add+html+to+last+element&amp;tbo=1&amp;sa=X&amp;ved=0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQHwgkMAE" style="color: rgb(51, 51, 51); cursor: pointer; display: block; padding: 7px 18px; outline: 0px; font-size: 14px;"></a></li></ol></div></div><a class="fl" href="https://translate.google.com.vn/translate?hl=vi&amp;sl=en&amp;u=http://api.jquery.com/append/&amp;prev=search" style="color: rgb(26, 13, 171); cursor: pointer; font-size: 14px;">Dịch trang này</a></div><span class="st" style="line-height: 1.4; word-wrap: break-word;">DOM&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">element</span>, text node, array of&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">elements</span>&nbsp;and text nodes,&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">HTML</span>&nbsp;string, ... as the&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">last</span>&nbsp;child of each<span style="font-weight: bold; color: rgb(106, 106, 106);">element</span>&nbsp;in the&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">jQuery</span>&nbsp;collection (To&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">insert</span>&nbsp;it as the first child,&nbsp;...</span><div class="_Tib" style="color: rgb(128, 128, 128);">Bạn đã truy cập trang này 4 lần. Lần truy cập cuối: 05/10/2016</div></div></div></div><div class="g" style="line-height: 1.2; font-size: small; margin-bottom: 26px;"><div class="rc" data-hveid="40" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQFQgoKAIwAg" style="position: relative;"><h3 class="r" style="font-size: 18px; margin: 0px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><a href="http://api.jquery.com/prepend/" style="color: rgb(102, 0, 153); cursor: pointer;">.prepend() | jQuery API Documentation</a></h3><div class="s" style="max-width: 48em; color: rgb(84, 84, 84); line-height: 18px;"><div class="f kv _SWb" style="color: rgb(128, 128, 128); height: 18px; line-height: 16px; white-space: nowrap;"><cite class="_Rm bc" style="color: rgb(0, 102, 33); font-style: normal; font-size: 14px;">api.jquery.com › Manipulation › DOM Insertion, Inside</cite><div class="action-menu ab_ctl" style="display: inline; position: relative; margin-top: 1px; margin-right: 3px; margin-left: 3px; user-select: none; vertical-align: middle;"><a class="_Fmb ab_button" href="https://www.google.com.vn/?gws_rd=ssl#" id="am-b2" aria-label="Chi tiết về kết quả tìm kiếm" aria-expanded="false" aria-haspopup="true" role="button" jsaction="m.tdd;keydown:m.hbke;keypress:m.mskpe" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQ7B0IKzAC" style="border-radius: 0px; cursor: default; font-size: 11px; font-weight: bold; height: 12px; line-height: 27px; margin: 1px 0px 2px; min-width: 0px; text-align: center; transition: none; user-select: none; background-color: white; background-image: none; border: 0px; color: rgb(128, 128, 128); box-shadow: 0px 0px 0px 0px; filter: none; width: 13px; display: inline-block;"><span class="mn-dwn-arw" style="border-color: rgb(0, 102, 33) transparent; border-style: solid; border-width: 5px 4px 0px !important; width: 0px; height: 0px; margin-left: 3px; top: 7.5px; margin-top: -4px; position: absolute; left: 0px;"></span></a><div class="action-menu-panel ab_dropdown" role="menu" tabindex="-1" jsaction="keydown:m.hdke;mouseover:m.hdhne;mouseout:m.hdhue" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQqR8ILDAC" style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 1px solid rgba(0, 0, 0, 0.2); font-size: 13px; position: absolute; right: auto; top: 12px; z-index: 3; transition: opacity 0.218s; box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 4px; left: 0px; visibility: hidden;"><ol style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px; border: 0px;"><li class="action-menu-item ab_dropdownitem" role="menuitem" style="margin-right: 0px; margin-left: 0px; border: 0px; list-style: none; user-select: none; cursor: pointer;"><a class="fl" href="http://webcache.googleusercontent.com/search?q=cache:oyOyx2N44wgJ:api.jquery.com/prepend/+&amp;cd=3&amp;hl=vi&amp;ct=clnk&amp;gl=vn" style="color: rgb(51, 51, 51); cursor: pointer; display: block; padding: 7px 18px; outline: 0px; font-size: 14px;"></a></li><li class="action-menu-item ab_dropdownitem" role="menuitem" style="margin-right: 0px; margin-left: 0px; border: 0px; list-style: none; user-select: none; cursor: pointer;"><a class="fl" href="https://www.google.com.vn/search?biw=1366&amp;bih=638&amp;q=related:api.jquery.com/prepend/+js+add+html+to+last+element&amp;tbo=1&amp;sa=X&amp;ved=0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQHwguMAI" style="color: rgb(51, 51, 51); cursor: pointer; display: block; padding: 7px 18px; outline: 0px; font-size: 14px;"></a></li></ol></div></div><a class="fl" href="https://translate.google.com.vn/translate?hl=vi&amp;sl=en&amp;u=http://api.jquery.com/prepend/&amp;prev=search" style="color: rgb(26, 13, 171); cursor: pointer; font-size: 14px;">Dịch trang này</a></div><span class="st" style="line-height: 1.4; word-wrap: break-word;">DOM&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">element</span>, text node, array of&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">elements</span>&nbsp;and text nodes,&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">HTML</span>&nbsp;string, ... of each&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">element</span>&nbsp;in the<span style="font-weight: bold; color: rgb(106, 106, 106);">jQuery</span>&nbsp;collection (To&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">insert</span>&nbsp;it as the&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">last</span>&nbsp;child, use .<span style="font-weight: bold; color: rgb(106, 106, 106);">append</span>() )<wbr>.</span><div class="_Tib" style="color: rgb(128, 128, 128);">Bạn đã truy cập trang này 2 lần. Lần truy cập cuối: 21/12/2016</div></div></div></div><div class="g" style="line-height: 1.2; font-size: small; margin-bottom: 26px;"><div class="rc" data-hveid="50" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQFQgyKAMwAw" style="position: relative;"><h3 class="r" style="font-size: 18px; margin: 0px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><a href="https://api.jquery.com/last/" style="color: rgb(102, 0, 153); cursor: pointer;">.last() | jQuery API Documentation</a></h3><div class="s" style="max-width: 48em; color: rgb(84, 84, 84); line-height: 18px;"><div class="f kv _SWb" style="color: rgb(128, 128, 128); height: 18px; line-height: 16px; white-space: nowrap;"><cite class="_Rm" style="color: rgb(0, 102, 33); font-style: normal; font-size: 14px;">https://api.<b>jquery</b>.com/<b>last</b>/</cite><div class="action-menu ab_ctl" style="display: inline; position: relative; margin-top: 1px; margin-right: 3px; margin-left: 3px; user-select: none; vertical-align: middle;"><a class="_Fmb ab_button" href="https://www.google.com.vn/?gws_rd=ssl#" id="am-b3" aria-label="Chi tiết về kết quả tìm kiếm" aria-expanded="false" aria-haspopup="true" role="button" jsaction="m.tdd;keydown:m.hbke;keypress:m.mskpe" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQ7B0INDAD" style="border-radius: 0px; cursor: default; font-size: 11px; font-weight: bold; height: 12px; line-height: 27px; margin: 1px 0px 2px; min-width: 0px; text-align: center; transition: none; user-select: none; background-color: white; background-image: none; border: 0px; color: rgb(128, 128, 128); box-shadow: 0px 0px 0px 0px; filter: none; width: 13px; display: inline-block;"><span class="mn-dwn-arw" style="border-color: rgb(0, 102, 33) transparent; border-style: solid; border-width: 5px 4px 0px !important; width: 0px; height: 0px; margin-left: 3px; top: 7.5px; margin-top: -4px; position: absolute; left: 0px;"></span></a><div class="action-menu-panel ab_dropdown" role="menu" tabindex="-1" jsaction="keydown:m.hdke;mouseover:m.hdhne;mouseout:m.hdhue" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQqR8INTAD" style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 1px solid rgba(0, 0, 0, 0.2); font-size: 13px; position: absolute; right: auto; top: 12px; z-index: 3; transition: opacity 0.218s; box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 4px; left: 0px; visibility: hidden;"><ol style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px; border: 0px;"><li class="action-menu-item ab_dropdownitem" role="menuitem" style="margin-right: 0px; margin-left: 0px; border: 0px; list-style: none; user-select: none; cursor: pointer;"><a class="fl" href="https://webcache.googleusercontent.com/search?q=cache:DyIrsUMDercJ:https://api.jquery.com/last/+&amp;cd=4&amp;hl=vi&amp;ct=clnk&amp;gl=vn" style="color: rgb(51, 51, 51); cursor: pointer; display: block; padding: 7px 18px; outline: 0px; font-size: 14px;"></a></li><li class="action-menu-item ab_dropdownitem" role="menuitem" style="margin-right: 0px; margin-left: 0px; border: 0px; list-style: none; user-select: none; cursor: pointer;"><a class="fl" href="https://www.google.com.vn/search?biw=1366&amp;bih=638&amp;q=related:https://api.jquery.com/last/+js+add+html+to+last+element&amp;tbo=1&amp;sa=X&amp;ved=0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQHwg3MAM" style="color: rgb(51, 51, 51); cursor: pointer; display: block; padding: 7px 18px; outline: 0px; font-size: 14px;"></a></li></ol></div></div><a class="fl" href="https://translate.google.com.vn/translate?hl=vi&amp;sl=en&amp;u=https://api.jquery.com/last/&amp;prev=search" style="color: rgb(26, 13, 171); cursor: pointer; font-size: 14px;">Dịch trang này</a></div><span class="st" style="line-height: 1.4; word-wrap: break-word;">Given a&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">jQuery</span>&nbsp;object that represents a set of DOM elements, the .last() method constructs a new<span style="font-weight: bold; color: rgb(106, 106, 106);">jQuery</span>&nbsp;object from the&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">last element</span>&nbsp;in that set. Consider a page with a simple list on it: ... &lt;!doctype<span style="font-weight: bold; color: rgb(106, 106, 106);">html</span>&gt;. &lt;<span style="font-weight: bold; color: rgb(106, 106, 106);">html</span>&nbsp;lang="en"&gt;. &lt;head&gt;.</span></div></div></div></div></div></div></div>', 0, 1483378977, 1, 0, 0),
(49, 214, '<h2 class="hd" style="position: absolute; width: 1px; height: 1px; top: -1000em; overflow: hidden; color: rgb(34, 34, 34); font-family: arial, sans-serif;">Kết quả tìm kiếm</h2><div data-async-context="query:js%20add%20html%20to%20last%20element" id="ires" style="margin-top: 6px; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: medium;"><div eid="tYxqWOvTPMeMvQSjtaGYAQ" id="rso"><div class="_NId"><div class="srg"><div class="g" style="line-height: 1.2; font-size: small; margin-bottom: 26px;"><div class="rc" data-hveid="22" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQFQgWKAAwAA" style="position: relative;"><h3 class="r" style="font-size: 18px; margin: 0px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><a href="http://www.w3schools.com/jsref/prop_node_lastchild.asp" style="color: rgb(102, 0, 153); cursor: pointer;">HTML DOM Node lastChild Property - W3Schools</a></h3><div class="s" style="max-width: 48em; color: rgb(84, 84, 84); line-height: 18px;"><div class="f kv _SWb" style="color: rgb(128, 128, 128); height: 18px; line-height: 16px; white-space: nowrap;"><cite class="_Rm" style="color: rgb(0, 102, 33); font-style: normal; font-size: 14px;">www.w3schools.com/jsref/prop_node_<b>last</b>child.asp</cite><div class="action-menu ab_ctl" style="display: inline; position: relative; margin-top: 1px; margin-right: 3px; margin-left: 3px; user-select: none; vertical-align: middle;"><a class="_Fmb ab_button" href="https://www.google.com.vn/?gws_rd=ssl#" id="am-b0" aria-label="Chi tiết về kết quả tìm kiếm" aria-expanded="false" aria-haspopup="true" role="button" jsaction="m.tdd;keydown:m.hbke;keypress:m.mskpe" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQ7B0IGDAA" style="border-radius: 0px; cursor: default; font-size: 11px; font-weight: bold; height: 12px; line-height: 27px; margin: 1px 0px 2px; min-width: 0px; text-align: center; transition: none; user-select: none; background-color: white; background-image: none; border: 0px; color: rgb(128, 128, 128); box-shadow: 0px 0px 0px 0px; filter: none; width: 13px; display: inline-block;"><span class="mn-dwn-arw" style="border-color: rgb(0, 102, 33) transparent; border-style: solid; border-width: 5px 4px 0px !important; width: 0px; height: 0px; margin-left: 3px; top: 7.5px; margin-top: -4px; position: absolute; left: 0px;"></span></a><div class="action-menu-panel ab_dropdown" role="menu" tabindex="-1" jsaction="keydown:m.hdke;mouseover:m.hdhne;mouseout:m.hdhue" data-ved="0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQqR8IGTAA" style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 1px solid rgba(0, 0, 0, 0.2); font-size: 13px; position: absolute; right: auto; top: 12px; z-index: 3; transition: opacity 0.218s; box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 4px; left: 0px; visibility: hidden;"><ol style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px; border: 0px;"><li class="action-menu-item ab_dropdownitem" role="menuitem" style="margin-right: 0px; margin-left: 0px; border: 0px; list-style: none; user-select: none; cursor: pointer;"><a class="fl" href="http://webcache.googleusercontent.com/search?q=cache:7UPBXRro8ecJ:www.w3schools.com/jsref/prop_node_lastchild.asp+&amp;cd=1&amp;hl=vi&amp;ct=clnk&amp;gl=vn" style="color: rgb(51, 51, 51); cursor: pointer; display: block; padding: 7px 18px; outline: 0px; font-size: 14px;"></a></li><li class="action-menu-item ab_dropdownitem" role="menuitem" style="margin-right: 0px; margin-left: 0px; border: 0px; list-style: none; user-select: none; cursor: pointer;"><a class="fl" href="https://www.google.com.vn/search?biw=1366&amp;bih=638&amp;q=related:www.w3schools.com/jsref/prop_node_lastchild.asp+js+add+html+to+last+element&amp;tbo=1&amp;sa=X&amp;ved=0ahUKEwirgtCM_aPRAhVHRo8KHaNaCBMQHwgbMAA" style="color: rgb(51, 51, 51); cursor: pointer; display: block; padding: 7px 18px; outline: 0px; font-size: 14px;"></a></li></ol></div></div><a class="fl" href="https://translate.google.com.vn/translate?hl=vi&amp;sl=en&amp;u=http://www.w3schools.com/jsref/prop_node_lastchild.asp&amp;prev=search" style="color: rgb(26, 13, 171); cursor: pointer; font-size: 14px;">Dịch trang này</a></div><span class="st" style="line-height: 1.4; word-wrap: break-word;">The difference between this property and lastElementChild, is that lastChild returns the&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">last</span>&nbsp;child node as an&nbsp;<span style="font-weight: bold; color: rgb(106, 106, 106);">element</span>&nbsp;node, a text node or a comment node&nbsp;.</span></div></div></div></div></div></div></div>', 0, 1483379001, 1, 0, 0),
(59, 211, '<p>Chào 123...</p>', 0, 1483379725, 1, 0, 0),
(62, 214, '<p>12345 876 910</p>', 0, 1483476209, 1, 1483562996, 1),
(63, 212, '<p>ABc</p>', 0, 1483477520, 1, 0, 0),
(64, 212, '1234', 0, 1483477523, 1, 0, 0),
(65, 212, 'm', 0, 1483477525, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_forum_like`
--

CREATE TABLE IF NOT EXISTS `olala3w_forum_like` (
`forum_like_id` double NOT NULL,
  `forum_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `olala3w_forum_like`
--

INSERT INTO `olala3w_forum_like` (`forum_like_id`, `forum_id`, `user_id`, `modified_time`) VALUES
(22, 214, 1, 1483561952),
(23, 214, 25, 1484257726);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_forum_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_forum_menu` (
`forum_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT 'not-found',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `folder` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `comment` text NOT NULL,
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=228 ;

--
-- Dumping data for table `olala3w_forum_menu`
--

INSERT INTO `olala3w_forum_menu` (`forum_menu_id`, `category_id`, `name`, `slug`, `title`, `description`, `keywords`, `parent`, `sort`, `is_active`, `hot`, `folder`, `img`, `comment`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(217, 96, 'Adventures tours', 'adventures-tours', '', '', '', 0, 1, 1, 0, '', 'no', '', 1480439143, 1, 1482070656, 0),
(218, 96, 'Demo', 'demo', '', '', '', 0, 2, 1, 0, 'admin\\12-2016\\', 'demo-218.jpg', '', 1480608189, 1, 1481794189, 1),
(219, 96, 'Level 1', 'level-1', '', '', '', 217, 1, 1, 0, 'admin\\12-2016\\', 'no', '', 1481772188, 1, 1481818252, 0),
(221, 96, 'Level 2', 'level-2', '', '', '', 217, 2, 1, 0, 'admin\\12-2016\\', 'no', '', 1481797148, 1, 1481818253, 0),
(222, 96, 'Level 1.1', 'level-1-1', '', '', '', 219, 1, 1, 0, 'admin\\12-2016\\', 'no', '', 1481797156, 1, 1481817712, 0),
(223, 96, 'Level 1.2', 'level-1-2', '', '', '', 219, 2, 1, 0, 'admin\\12-2016\\', 'no', '', 1481797163, 1, 1481797163, 0),
(224, 96, 'Level 1.3', 'level-1-3', '', '', '', 219, 3, 1, 0, 'admin\\12-2016\\', 'no', '', 1481797170, 1, 1481797170, 0),
(225, 96, 'Level 3', 'level-3', '', '', '', 217, 3, 1, 0, 'admin\\12-2016\\', 'no', '', 1481797189, 1, 1481818253, 0),
(226, 96, 'Level 3.1', 'level-3-1', '', '', '', 225, 1, 1, 0, 'admin\\12-2016\\', 'no', '', 1481797199, 1, 1481797199, 0),
(227, 96, 'Level 3.2', 'level-3-2', '', '', '', 225, 2, 1, 0, 'admin\\12-2016\\', 'no', '', 1481797207, 1, 1481797207, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_gallery`
--

CREATE TABLE IF NOT EXISTS `olala3w_gallery` (
`gallery_id` int(11) NOT NULL,
  `gallery_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT '-no-',
  `upload_id` bigint(20) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `content` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=614 ;

--
-- Dumping data for table `olala3w_gallery`
--

INSERT INTO `olala3w_gallery` (`gallery_id`, `gallery_menu_id`, `name`, `title`, `description`, `keywords`, `img`, `upload_id`, `comment`, `content`, `link`, `is_active`, `hot`, `views`, `created_time`, `modified_time`, `user_id`) VALUES
(612, 80, 'Hình 2', '', '', '', 'nuakjc0jr57kowl-612-hinh-2.jpg', 1593, '<h3 class="title-des">Sẵn sàng học mọi kỹ năng để làm chủ tương lai</h3>							<div class="row description-carousel">								<div class="col-sm-4 align-right">									<p><i aria-hidden="true" class="fa fa-database">&nbsp;</i>500+ Khóa học									</p>								</div>								<div class="col-sm-4">									<p><i aria-hidden="true" class="fa fa-users">&nbsp;</i>200+ Giảng viên									</p>								</div>								<div class="col-sm-4 align-left">									<p><i aria-hidden="true" class="fa fa-graduation-cap">&nbsp;</i>250,000 Học viên									</p>								</div>							</div>							<a class="button" href="/khoa-hoc">Khám phá e-Learning</a>', '', '', 1, 0, 1, 1481652480, 1481653688, 1),
(611, 80, 'Hình 1', '', '', '', '0io468nm6l2i1cq-611-hinh-1.jpg', 1592, '<h3 class="title-des">Dễ học, dễ ứng dụng ngay</h3>							<div class="row description-carousel">								<div class="col-sm-6 align-right">									<p><i aria-hidden="true" class="fa fa-check-square-o">&nbsp;</i>Ví dụ cụ thể, minh họa sinh động									</p>								</div>								<div class="col-sm-6 align-left">									<p><i aria-hidden="true" class="fa fa-paper-plane">&nbsp;</i>Kho bài tập đa dạng, áp dụng thực tế ngay									</p>								</div>							</div>							<a class="button" href="/khoa-hoc">Khám phá e-Learning</a>', '', '', 1, 0, 1, 1481652540, 1481653305, 1),
(613, 80, 'Hình 3', '', '', '', 'y8bennv3c1jy1a3-613-hinh-3.jpg', 1594, '<h3 class="title-des">Trải nghiệm học tập không giới hạn							</h3>							<div class="row description-carousel">								<div class="col-sm-6 align-right">									<p><i aria-hidden="true" class="fa fa-laptop">&nbsp;</i>Máy tính, internet									</p>								</div>								<div class="col-sm-6 align-left">									<p><i aria-hidden="true" class="fa fa-map-marker">&nbsp;</i>Bất kì nơi nào									</p>								</div>							</div>							<a class="button" href="/khoa-hoc">Khám phá e-Learning</a>', '', '', 1, 0, 1, 1481652420, 1481653530, 1);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_gallery_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_gallery_menu` (
`gallery_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT 'not-found',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `comment` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `img` varchar(255) NOT NULL DEFAULT '-no-',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `olala3w_gallery_menu`
--

INSERT INTO `olala3w_gallery_menu` (`gallery_menu_id`, `category_id`, `name`, `slug`, `title`, `description`, `keywords`, `parent`, `sort`, `comment`, `is_active`, `hot`, `img`, `created_time`, `modified_time`, `user_id`) VALUES
(80, 91, 'Slider intro', 'slider-intro', '', '', '', 0, 1, '', 1, 0, '-no-', 1481652457, 1481652457, 1);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_gift`
--

CREATE TABLE IF NOT EXISTS `olala3w_gift` (
`gift_id` int(11) NOT NULL,
  `gift_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `img_note` varchar(255) NOT NULL,
  `price` bigint(15) NOT NULL DEFAULT '0',
  `made` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `content` longtext NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_gift_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_gift_menu` (
`gift_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT 'not-found',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=144 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_location`
--

CREATE TABLE IF NOT EXISTS `olala3w_location` (
`location_id` int(11) NOT NULL,
  `location_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_location_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_location_menu` (
`location_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `img` varchar(255) DEFAULT 'no',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_notify`
--

CREATE TABLE IF NOT EXISTS `olala3w_notify` (
`notify_id` double NOT NULL,
  `msg` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `post` int(11) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `olala3w_notify`
--

INSERT INTO `olala3w_notify` (`notify_id`, `msg`, `type`, `post`, `created_time`, `user_id`) VALUES
(2, 1, 'product', 3, 1483561424, 1),
(3, 2, 'product', 3, 1483561502, 1),
(4, 6, 'forum', 214, 1483561794, 1),
(5, 8, 'forum', 214, 1483561952, 1),
(6, 9, 'forum', 214, 1483562453, 1),
(7, 10, 'forum', 214, 1483562479, 1),
(8, 11, 'forum', 214, 1483562493, 1),
(9, 10, 'forum', 214, 1483562595, 1),
(10, 10, 'forum', 214, 1483562634, 1),
(11, 10, 'forum', 214, 1483562776, 1),
(12, 10, 'forum', 214, 1483562875, 1),
(13, 10, 'forum', 214, 1483562996, 1),
(14, 12, 'user', 0, 1484069444, 0),
(15, 12, 'user', 29, 1484069533, 0),
(16, 12, 'user', 30, 1484069763, 0),
(17, 9, 'forum', 214, 1484249809, 25),
(18, 2, 'product', 3, 1484253802, 25),
(19, 2, 'product', 3, 1484253962, 25),
(20, 1, 'product', 3, 1484253965, 25),
(21, 2, 'product', 3, 1484253970, 25),
(22, 2, 'product', 3, 1484253973, 25),
(23, 2, 'product', 3, 1484253976, 25),
(24, 11, 'forum', 214, 1484254320, 25),
(25, 1, 'product', 3, 1484255818, 25),
(26, 1, 'product', 3, 1484257299, 25),
(27, 8, 'forum', 214, 1484257726, 25);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_notify_logs`
--

CREATE TABLE IF NOT EXISTS `olala3w_notify_logs` (
`notify_logs_id` double NOT NULL,
  `notify_status_id` double NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `modified_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_notify_status`
--

CREATE TABLE IF NOT EXISTS `olala3w_notify_status` (
`notify_status_id` double NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `notify_id` double NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `olala3w_notify_status`
--

INSERT INTO `olala3w_notify_status` (`notify_status_id`, `type`, `notify_id`, `user_id`, `status`, `modified_time`) VALUES
(2, 1, 2, 1, 1, 1484258621),
(3, 1, 2, 25, 1, 1484257717),
(4, 1, 3, 1, 1, 1484258621),
(5, 1, 3, 25, 1, 1484257717),
(6, 1, 4, 1, 1, 1484257734),
(7, 1, 4, 25, 1, 1484257723),
(8, 1, 5, 1, 1, 1484257734),
(9, 1, 5, 25, 1, 1484257723),
(10, 1, 6, 1, 1, 1484257734),
(11, 1, 6, 25, 1, 1484257723),
(12, 1, 7, 1, 1, 1484257734),
(13, 1, 7, 25, 1, 1484257723),
(14, 1, 8, 1, 1, 1484257734),
(15, 1, 8, 25, 1, 1484257723),
(16, 1, 9, 1, 1, 1484257734),
(17, 1, 9, 25, 1, 1484257723),
(18, 1, 10, 1, 1, 1484257734),
(19, 1, 10, 25, 1, 1484257723),
(20, 1, 11, 1, 1, 1484257734),
(21, 1, 11, 25, 1, 1484257723),
(22, 1, 12, 1, 1, 1484257734),
(23, 1, 12, 25, 1, 1484257723),
(24, 1, 13, 1, 1, 1484257734),
(25, 1, 13, 25, 1, 1484257723),
(26, 0, 13, 1, 1, 1484258641),
(27, 0, 13, 25, 0, 1483562996),
(28, 0, 16, 1, 1, 1484257084),
(29, 0, 16, 25, 0, 1484069763),
(30, 1, 17, 25, 1, 1484257723),
(31, 1, 17, 1, 1, 1484257734),
(32, 0, 17, 1, 1, 1484258641),
(33, 0, 17, 25, 1, 1484249809),
(34, 1, 18, 25, 1, 1484257717),
(35, 1, 18, 1, 1, 1484258621),
(36, 0, 18, 1, 1, 1484257430),
(37, 0, 18, 25, 1, 1484253802),
(38, 1, 19, 25, 1, 1484257717),
(39, 1, 19, 1, 1, 1484258621),
(40, 0, 19, 1, 1, 1484257430),
(41, 0, 19, 25, 1, 1484253962),
(42, 1, 20, 25, 1, 1484257717),
(43, 1, 20, 1, 1, 1484258621),
(44, 0, 20, 1, 1, 1484257430),
(45, 0, 20, 25, 1, 1484253965),
(46, 1, 21, 25, 1, 1484257717),
(47, 1, 21, 1, 1, 1484258621),
(48, 0, 21, 1, 1, 1484257430),
(49, 0, 21, 25, 1, 1484253970),
(50, 1, 22, 25, 1, 1484257717),
(51, 1, 22, 1, 1, 1484258621),
(52, 0, 22, 1, 1, 1484257430),
(53, 0, 22, 25, 1, 1484253973),
(54, 1, 23, 25, 1, 1484257717),
(55, 1, 23, 1, 1, 1484258621),
(56, 0, 23, 1, 1, 1484257430),
(57, 0, 23, 25, 1, 1484253976),
(58, 1, 24, 25, 1, 1484257723),
(59, 1, 24, 1, 1, 1484257734),
(60, 0, 24, 1, 1, 1484258641),
(61, 0, 24, 25, 1, 1484254320),
(62, 1, 25, 25, 1, 1484257717),
(63, 1, 25, 1, 1, 1484258621),
(64, 0, 25, 1, 1, 1484257430),
(65, 0, 25, 25, 1, 1484255818),
(66, 1, 26, 25, 1, 1484257717),
(67, 1, 26, 1, 1, 1484258621),
(68, 0, 26, 1, 1, 1484257430),
(69, 0, 26, 25, 1, 1484257299),
(70, 1, 27, 25, 1, 1484257726),
(71, 1, 27, 1, 1, 1484257734),
(72, 0, 27, 1, 1, 1484258641),
(73, 0, 27, 25, 1, 1484257726);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_online`
--

CREATE TABLE IF NOT EXISTS `olala3w_online` (
`online_id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL,
  `site` varchar(255) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4257 ;

--
-- Dumping data for table `olala3w_online`
--

INSERT INTO `olala3w_online` (`online_id`, `ip`, `created_time`, `site`, `agent`, `user_id`) VALUES
(4205, '127.0.0.1', 1484257685, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4206, '127.0.0.1', 1484257689, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4207, '127.0.0.1', 1484257692, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4208, '127.0.0.1', 1484257705, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4209, '127.0.0.1', 1484257708, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4210, '127.0.0.1', 1484257712, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4211, '127.0.0.1', 1484257717, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4212, '127.0.0.1', 1484257718, 'url=dien-dan', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4213, '127.0.0.1', 1484257721, 'url=dien-dan/adventures-tours', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4214, '127.0.0.1', 1484257723, 'url=dien-dan/adventures-tours/trump-noi-trung-quoc-cu-giu-lay-thiet-bi-lan-cua-my-edit-123-214.html', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4215, '127.0.0.1', 1484257723, 'url=dien-dan/adventures-tours/img/sprites.svg&v=8c1c8cba242e', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4216, '127.0.0.1', 1484257729, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4217, '127.0.0.1', 1484257734, 'url=dien-dan/adventures-tours/trump-noi-trung-quoc-cu-giu-lay-thiet-bi-lan-cua-my-edit-123-214.html', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4218, '127.0.0.1', 1484257735, 'url=dien-dan/adventures-tours/img/sprites.svg&v=8c1c8cba242e', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4219, '127.0.0.1', 1484257737, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4220, '127.0.0.1', 1484258104, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4221, '127.0.0.1', 1484258106, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html&list=3', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4222, '127.0.0.1', 1484258170, 'url=css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4223, '127.0.0.1', 1484258394, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html&list=3', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4224, '127.0.0.1', 1484258395, 'url=css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4225, '127.0.0.1', 1484258401, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html&list=3', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4226, '127.0.0.1', 1484258478, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html&list=3', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4227, '127.0.0.1', 1484258482, 'url=css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4228, '127.0.0.1', 1484258556, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html&list=3', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4229, '127.0.0.1', 1484258566, 'url=css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4230, '127.0.0.1', 1484258584, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html&list=3', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4231, '127.0.0.1', 1484258588, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html&list=3', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4232, '127.0.0.1', 1484258615, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html&list=3', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4233, '127.0.0.1', 1484258621, 'url=khoa-hoc/thiet-ke-do-hoa/lam-chu-adobe-photoshop-cc-trong-3-gio-3.html', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4234, '127.0.0.1', 1484258623, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4235, '127.0.0.1', 1484258642, 'url=olala-admin/img/sprites.svg&v=8c1c8cba242e', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4236, '127.0.0.1', 1484258655, '', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4237, '127.0.0.1', 1484258655, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4238, '127.0.0.1', 1484258661, 'url=css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4239, '127.0.0.1', 1484258711, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4240, '127.0.0.1', 1484258718, 'url=css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4241, '127.0.0.1', 1484258724, 'url=notification/load_more', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4242, '127.0.0.1', 1484258725, 'url=notification/load_more', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4243, '127.0.0.1', 1484258858, 'url=olala-admin/css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4244, '127.0.0.1', 1484258861, 'url=olala-admin/css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4245, '127.0.0.1', 1484259026, 'url=olala-admin/css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4246, '127.0.0.1', 1484259123, 'url=olala-admin/css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4247, '127.0.0.1', 1484259137, 'url=olala-admin/css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4248, '127.0.0.1', 1484259400, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4249, '127.0.0.1', 1484259403, 'url=notification/load_more', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4250, '127.0.0.1', 1484259405, 'url=notification/load_more', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4251, '127.0.0.1', 1484259411, 'url=notification/load_more', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4252, '127.0.0.1', 1484259413, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4253, '127.0.0.1', 1484259416, 'url=olala-admin/js/highcharts/graphics/loader.white.gif', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4254, '127.0.0.1', 1484259422, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4255, '127.0.0.1', 1484259424, 'url=olala-admin/css/materialdesignicons.min.css.map', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0),
(4256, '127.0.0.1', 1484259432, 'url=home', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_online_daily`
--

CREATE TABLE IF NOT EXISTS `olala3w_online_daily` (
`online_daily_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=508 ;

--
-- Dumping data for table `olala3w_online_daily`
--

INSERT INTO `olala3w_online_daily` (`online_daily_id`, `date`, `count`) VALUES
(1, '2014-08-18', 3),
(2, '2014-08-17', 1),
(3, '2014-08-14', 102),
(4, '2014-08-06', 100),
(5, '2014-08-16', 3),
(6, '2014-08-13', 10),
(7, '2014-08-11', 40),
(8, '2014-08-09', 90),
(9, '2014-08-15', 82),
(10, '2014-08-12', 207),
(11, '2014-08-10', 10),
(12, '2014-08-08', 7),
(13, '2014-08-07', 13),
(14, '2014-08-19', 13),
(15, '2014-08-20', 9),
(16, '2014-08-21', 135),
(17, '2014-08-22', 5),
(18, '2014-09-27', 7),
(19, '2014-09-28', 16),
(20, '2014-09-29', 5),
(21, '2014-09-30', 14),
(22, '2014-10-01', 16),
(23, '2014-10-02', 12),
(24, '2014-10-03', 7),
(25, '2014-10-04', 1),
(26, '2014-10-05', 2),
(27, '2014-10-07', 4),
(28, '2014-10-08', 11),
(29, '2014-10-14', 1),
(30, '2014-10-20', 1),
(31, '2014-10-26', 4),
(32, '2014-10-27', 9),
(33, '2014-10-28', 11),
(34, '2014-10-29', 13),
(35, '2014-10-30', 10),
(36, '2014-10-31', 14),
(37, '2014-11-01', 8),
(38, '2014-11-02', 12),
(39, '2014-11-03', 2),
(40, '2014-11-05', 4),
(41, '2014-11-06', 2),
(42, '2014-11-07', 4),
(43, '2014-11-08', 1),
(44, '2014-11-09', 1),
(45, '2014-11-10', 11),
(46, '2014-11-11', 8),
(47, '2014-11-12', 3),
(48, '2014-11-13', 5),
(49, '2014-11-14', 6),
(50, '2014-11-15', 1),
(51, '2014-11-16', 1),
(52, '2014-11-17', 4),
(53, '2014-11-18', 1),
(54, '2014-11-19', 4),
(55, '2014-11-20', 1),
(56, '2014-11-21', 4),
(57, '2014-11-22', 1),
(58, '2014-11-23', 16),
(59, '2014-11-24', 1),
(60, '2014-11-25', 5),
(61, '2014-11-27', 15),
(62, '2014-11-28', 18),
(63, '2014-11-29', 10),
(64, '2014-11-30', 10),
(65, '2014-12-01', 6),
(66, '2014-12-02', 13),
(67, '2014-12-03', 9),
(68, '2014-12-04', 9),
(69, '2014-12-05', 7),
(70, '2014-12-06', 1),
(71, '2014-12-08', 5),
(72, '2014-12-09', 2),
(73, '2014-12-10', 5),
(74, '2014-12-11', 13),
(75, '2014-12-12', 4),
(76, '2014-12-16', 2),
(77, '2014-12-20', 11),
(78, '2014-12-21', 6),
(79, '2014-12-22', 5),
(80, '2014-12-23', 3),
(81, '2014-12-24', 1),
(82, '2014-12-26', 2),
(83, '2014-12-27', 10),
(84, '0000-00-00', 1),
(85, '2014-12-28', 15),
(86, '2014-12-29', 11),
(87, '2014-12-30', 1),
(88, '2015-01-02', 11),
(89, '2015-01-03', 4),
(90, '2015-01-04', 2),
(91, '2015-01-05', 9),
(92, '2015-01-06', 7),
(93, '2015-01-07', 1),
(94, '2015-01-08', 7),
(95, '2015-01-09', 13),
(96, '2015-01-10', 2),
(97, '2015-01-12', 1),
(98, '2015-01-19', 2),
(99, '2015-01-20', 12),
(100, '2015-01-21', 8),
(101, '2015-01-22', 43),
(102, '2015-01-23', 36),
(103, '2015-01-24', 34),
(104, '2015-01-24', 34),
(105, '2015-01-25', 46),
(106, '2015-01-26', 51),
(107, '2015-01-27', 53),
(108, '2015-01-28', 46),
(109, '2015-01-29', 471),
(110, '2015-01-30', 191),
(111, '2015-01-31', 106),
(112, '2015-02-01', 61),
(113, '2015-02-02', 37),
(114, '2015-02-03', 53),
(115, '2015-02-04', 66),
(116, '2015-02-05', 63),
(117, '2015-02-06', 86),
(118, '2015-02-07', 63),
(119, '2015-02-08', 68),
(120, '2015-02-09', 64),
(121, '2015-02-10', 46),
(122, '2015-02-11', 53),
(123, '2015-02-12', 28),
(124, '2015-02-13', 155),
(125, '2015-02-14', 43),
(126, '2015-02-15', 27),
(127, '2015-02-16', 22),
(128, '2015-02-17', 20),
(129, '2015-02-18', 19),
(130, '2015-02-19', 16),
(131, '2015-02-20', 18),
(132, '2015-02-21', 33),
(133, '2015-02-22', 31),
(134, '2015-02-23', 34),
(135, '2015-02-24', 22),
(136, '2015-02-25', 26),
(137, '2015-02-26', 34),
(138, '2015-02-27', 19),
(139, '2015-02-28', 5),
(140, '2015-03-01', 12),
(141, '2015-03-02', 24),
(142, '2015-03-03', 48),
(143, '2015-03-04', 49),
(144, '2015-03-05', 43),
(145, '2015-03-06', 33),
(146, '2015-03-07', 52),
(147, '2015-03-08', 26),
(148, '2015-03-09', 46),
(149, '2015-03-10', 37),
(150, '2015-03-11', 47),
(151, '2015-03-12', 33),
(152, '2015-03-13', 28),
(153, '2015-03-14', 2),
(154, '2015-03-16', 5),
(155, '2015-03-17', 18),
(156, '2015-03-18', 11),
(157, '2015-03-19', 21),
(158, '2015-03-20', 18),
(159, '2015-03-21', 3),
(160, '2015-05-06', 5),
(161, '2015-05-07', 4),
(162, '2015-05-08', 3),
(163, '2015-05-09', 2),
(164, '2015-05-10', 8),
(165, '2015-05-11', 3),
(166, '2015-05-12', 4),
(167, '2015-05-15', 1),
(168, '2015-05-16', 2),
(169, '2015-05-17', 2),
(170, '2015-05-18', 1),
(171, '2015-05-19', 3),
(172, '2015-05-23', 1),
(173, '2015-05-24', 1),
(174, '2015-05-25', 2),
(175, '2015-05-26', 2),
(176, '2015-05-27', 4),
(177, '2015-05-28', 4),
(178, '2015-05-29', 3),
(179, '2015-05-31', 3),
(180, '2015-06-01', 1),
(181, '2015-06-02', 2),
(182, '2015-06-03', 3),
(183, '2015-06-04', 3),
(184, '2015-06-05', 1),
(185, '2015-06-06', 1),
(186, '2015-06-08', 1),
(187, '2015-06-09', 2),
(188, '2015-06-10', 1),
(189, '2015-06-11', 2),
(190, '2015-06-12', 3),
(191, '2015-06-13', 2),
(192, '2015-06-14', 1),
(193, '2015-06-15', 4),
(194, '2015-06-16', 1),
(195, '2015-06-17', 1),
(196, '2015-06-18', 1),
(197, '2015-06-21', 1),
(198, '2015-06-22', 3),
(199, '2015-06-23', 1),
(200, '2015-06-24', 8),
(201, '2015-06-28', 1),
(202, '2015-06-29', 3),
(203, '2015-06-30', 4),
(204, '2015-07-01', 4),
(205, '2015-07-02', 3),
(206, '2015-07-03', 3),
(207, '2015-07-06', 1),
(208, '2015-07-07', 1),
(209, '2015-07-12', 4),
(210, '2015-07-13', 6),
(211, '2015-07-14', 29),
(212, '2015-07-15', 190),
(213, '2015-07-16', 361),
(214, '2015-07-17', 354),
(215, '2015-07-18', 238),
(216, '2015-07-19', 343),
(217, '2015-07-20', 802),
(218, '2015-07-21', 1926),
(219, '2015-07-22', 1349),
(220, '2015-07-23', 1648),
(221, '2015-07-24', 2370),
(222, '2015-07-25', 4986),
(223, '2015-07-26', 2251),
(224, '2015-07-27', 3882),
(225, '2015-07-28', 3496),
(226, '2015-07-29', 3603),
(227, '2015-07-30', 2778),
(228, '2015-07-31', 5),
(229, '2015-08-01', 2),
(230, '2015-08-02', 3),
(231, '2015-08-03', 2),
(232, '2015-08-05', 5),
(233, '2015-08-06', 1),
(234, '2015-08-07', 5),
(235, '2015-08-08', 8),
(236, '2015-08-09', 7),
(237, '2015-08-10', 6),
(238, '2015-08-11', 1),
(239, '2015-08-12', 2),
(240, '2015-08-13', 3),
(241, '2015-08-14', 1),
(242, '2015-08-16', 2),
(243, '2015-08-17', 2),
(244, '2015-08-18', 1),
(245, '2015-08-28', 2),
(246, '2015-08-29', 1),
(247, '2015-08-30', 1),
(248, '2015-08-31', 3),
(249, '2015-09-01', 1),
(250, '2015-09-04', 1),
(251, '2015-09-05', 1),
(252, '2015-09-06', 1),
(253, '2015-09-07', 1),
(254, '2015-09-08', 1),
(255, '2015-09-09', 3),
(256, '2015-09-10', 3),
(257, '2015-09-11', 2),
(258, '2015-09-17', 1),
(259, '2015-09-27', 3),
(260, '2015-09-28', 2),
(261, '2015-10-19', 1),
(262, '2015-10-20', 4),
(263, '2015-10-21', 1),
(264, '2015-10-24', 1),
(265, '2015-10-25', 5),
(266, '2015-10-26', 22),
(267, '2015-10-27', 36),
(268, '2015-11-10', 1),
(269, '2015-11-11', 3),
(270, '2015-11-12', 22),
(271, '2015-11-13', 45),
(272, '2015-11-14', 9),
(273, '2015-11-15', 27),
(274, '2015-11-16', 36),
(275, '2015-11-17', 24),
(276, '2015-11-18', 10),
(277, '2015-11-19', 14),
(278, '2015-11-20', 7),
(279, '2015-11-21', 5),
(280, '2015-11-22', 1),
(281, '2015-11-23', 12),
(282, '2015-11-24', 5),
(283, '2015-11-27', 1),
(284, '2015-11-28', 2),
(285, '2015-11-29', 1),
(286, '2015-11-30', 4),
(287, '2015-12-01', 38),
(288, '2015-12-02', 34),
(289, '2015-12-03', 41),
(290, '2015-12-04', 34),
(291, '2015-12-09', 1),
(292, '2015-12-19', 1),
(293, '2015-12-20', 2),
(294, '2015-12-21', 7),
(295, '2015-12-22', 5),
(296, '2015-12-23', 52),
(297, '2015-12-24', 37),
(298, '2015-12-25', 39),
(299, '2015-12-26', 13),
(300, '2015-12-27', 2),
(301, '2015-12-28', 18),
(302, '2015-12-29', 9),
(303, '2015-12-30', 16),
(304, '2015-12-31', 6),
(305, '2016-01-07', 3),
(306, '2016-01-08', 3),
(307, '2016-01-09', 7),
(308, '2016-01-10', 1),
(309, '2016-01-12', 7),
(310, '2016-01-13', 4),
(311, '2016-01-14', 4),
(312, '2016-01-15', 14),
(313, '2016-01-16', 66),
(314, '2016-01-17', 45),
(315, '2016-01-18', 31),
(316, '2016-01-19', 7),
(317, '2016-01-20', 12),
(318, '2016-01-21', 5),
(319, '2016-01-22', 7),
(320, '2016-01-23', 4),
(321, '2016-01-24', 1),
(322, '2016-01-25', 25),
(323, '2016-01-26', 1),
(324, '2016-01-27', 11),
(325, '2016-01-28', 40),
(326, '2016-01-29', 35),
(327, '2016-01-30', 6),
(328, '2016-02-01', 14),
(329, '2016-02-02', 40),
(330, '2016-02-03', 163),
(331, '2016-02-04', 81),
(332, '2016-02-05', 63),
(333, '2016-02-06', 52),
(334, '2016-02-07', 38),
(335, '2016-02-08', 35),
(336, '2016-02-09', 48),
(337, '2016-02-10', 39),
(338, '2016-02-11', 34),
(339, '2016-02-12', 74),
(340, '2016-02-13', 56),
(341, '2016-02-14', 60),
(342, '2016-02-15', 104),
(343, '2016-02-16', 59),
(344, '2016-02-17', 58),
(345, '2016-02-18', 43),
(346, '2016-02-19', 2),
(347, '2016-02-20', 2),
(348, '2016-02-22', 3),
(349, '2016-03-01', 1),
(350, '2016-03-04', 3),
(351, '2016-03-04', 3),
(352, '2016-03-07', 1),
(353, '2016-03-08', 1),
(354, '2016-03-09', 14),
(355, '2016-03-10', 5),
(356, '2016-03-11', 6),
(357, '2016-03-13', 2),
(358, '2016-03-14', 1),
(359, '2016-03-20', 1),
(360, '2016-03-26', 8),
(361, '2016-03-27', 8),
(362, '2016-03-28', 46),
(363, '2016-03-29', 1),
(364, '2016-03-30', 11),
(365, '2016-03-31', 2),
(366, '2016-04-02', 1),
(367, '2016-04-03', 5),
(368, '2016-04-04', 10),
(369, '2016-04-05', 31),
(370, '2016-04-06', 65),
(371, '2016-04-07', 35),
(372, '2016-04-08', 15),
(373, '2016-04-09', 1),
(374, '2016-04-20', 2),
(375, '2016-04-22', 2),
(376, '2016-04-23', 7),
(377, '2016-04-24', 8),
(378, '2016-04-25', 1),
(379, '2016-04-26', 2),
(380, '2016-04-27', 4),
(381, '2016-04-28', 3),
(382, '2016-05-05', 1),
(383, '2016-05-08', 9),
(384, '2016-05-09', 3),
(385, '2016-05-10', 2),
(386, '2016-05-11', 5),
(387, '2016-05-12', 6),
(388, '2016-05-13', 11),
(389, '2016-05-15', 3),
(390, '2016-05-16', 8),
(391, '2016-05-17', 7),
(392, '2016-05-19', 3),
(393, '2016-05-19', 3),
(394, '2016-05-20', 2),
(395, '2016-05-22', 5),
(396, '2016-05-23', 1),
(397, '2016-05-24', 1),
(398, '2016-05-30', 5),
(399, '2016-06-16', 1),
(400, '2016-06-24', 5),
(401, '2016-06-25', 12),
(402, '2016-06-26', 5),
(403, '2016-08-08', 6),
(404, '2016-08-09', 4),
(405, '2016-08-10', 5),
(406, '2016-08-11', 2),
(407, '2016-08-12', 6),
(408, '2016-08-14', 1),
(409, '2016-08-16', 12),
(410, '2016-08-17', 39),
(411, '2016-08-18', 157),
(412, '2016-08-19', 196),
(413, '2016-08-20', 227),
(414, '2016-08-21', 190),
(415, '2016-08-22', 545),
(416, '2016-08-23', 367),
(417, '2016-08-24', 369),
(418, '2016-08-25', 418),
(419, '2016-08-26', 512),
(420, '2016-08-27', 614),
(421, '2016-08-28', 631),
(422, '2016-08-29', 728),
(423, '2016-08-30', 579),
(424, '2016-08-31', 333),
(425, '2016-09-01', 219),
(426, '2016-09-02', 108),
(427, '2016-09-03', 157),
(428, '2016-09-04', 156),
(429, '2016-09-05', 51),
(430, '2016-10-03', 4),
(431, '2016-10-04', 3),
(432, '2016-10-10', 2),
(433, '2016-10-12', 2),
(434, '2016-10-13', 6),
(435, '2016-10-14', 7),
(436, '2016-10-15', 3),
(437, '2016-10-16', 9),
(438, '2016-10-17', 10),
(439, '2016-10-18', 6),
(440, '2016-10-19', 3),
(441, '2016-10-20', 6),
(442, '2016-10-21', 6),
(443, '2016-10-22', 5),
(444, '2016-10-23', 9),
(445, '2016-10-24', 17),
(446, '2016-10-25', 4),
(447, '2016-10-26', 62),
(448, '2016-10-27', 290),
(449, '2016-10-28', 622),
(450, '2016-10-29', 2),
(451, '2016-10-29', 2),
(452, '2016-10-29', 2),
(453, '2016-10-30', 180),
(454, '2016-10-31', 34),
(455, '2016-11-01', 2),
(456, '2016-11-02', 7),
(457, '2016-11-03', 9),
(458, '2016-11-04', 1),
(459, '2016-11-07', 4),
(460, '2016-11-08', 5),
(461, '2016-11-09', 5),
(462, '2016-11-10', 126),
(463, '2016-11-11', 377),
(464, '2016-11-16', 1),
(465, '2016-11-19', 2),
(466, '2016-11-20', 51),
(467, '2016-11-21', 24),
(468, '2016-11-22', 1),
(469, '2016-11-25', 16),
(470, '2016-11-26', 78),
(471, '2016-11-27', 115),
(472, '2016-11-28', 4),
(473, '2016-11-29', 45),
(474, '2016-11-30', 5),
(475, '2016-12-01', 8),
(476, '2016-12-02', 1),
(477, '2016-12-03', 1),
(478, '2016-12-04', 8),
(479, '2016-12-05', 2),
(480, '2016-12-07', 7),
(481, '2016-12-08', 13),
(482, '2016-12-09', 7),
(483, '2016-12-11', 7),
(484, '2016-12-12', 15),
(485, '2016-12-13', 13),
(486, '2016-12-14', 34),
(487, '2016-12-15', 14),
(488, '2016-12-16', 4),
(489, '2016-12-17', 13),
(490, '2016-12-18', 135),
(491, '2016-12-19', 276),
(492, '2016-12-20', 9),
(493, '2016-12-21', 17),
(494, '2016-12-22', 28),
(495, '2016-12-23', 281),
(496, '2016-12-29', 4),
(497, '2016-12-30', 67),
(498, '2017-01-02', 111),
(499, '2017-01-03', 191),
(500, '2017-01-04', 172),
(501, '2017-01-05', 58),
(502, '2017-01-06', 1),
(503, '2017-01-07', 1),
(504, '2017-01-10', 2),
(505, '2017-01-11', 141),
(506, '2017-01-12', 2),
(507, '2017-01-13', 471);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_order`
--

CREATE TABLE IF NOT EXISTS `olala3w_order` (
`order_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `ip` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'fa-shopping-cart',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_others`
--

CREATE TABLE IF NOT EXISTS `olala3w_others` (
`others_id` int(11) NOT NULL,
  `others_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `p_from` varchar(255) NOT NULL,
  `p_to` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `olala3w_others`
--

INSERT INTO `olala3w_others` (`others_id`, `others_menu_id`, `name`, `p_from`, `p_to`, `sort`, `is_active`, `hot`, `created_time`, `modified_time`, `user_id`) VALUES
(4, 31, 'Đường Lê Duẩn', '', '', 1, 1, 0, 1466791881, 1466791881, 1),
(5, 31, 'Đường Hùng Vương', '', '', 2, 1, 0, 1466791889, 1466791889, 1),
(6, 31, 'Đường Nguyễn Văn Linh', '', '', 3, 1, 0, 1466791903, 1466791903, 1),
(7, 31, 'Đường Hải Phòng', '', '', 4, 1, 0, 1466791921, 1466791921, 1),
(8, 31, 'Đường Bạch Đằng', '', '', 5, 1, 0, 1466791931, 1466791931, 1),
(9, 31, 'Đường 2 Tháng 9', '', '', 6, 1, 0, 1466791947, 1466791947, 1),
(10, 31, 'Đường Nguyễn Hữu Thọ', '', '', 7, 1, 0, 1466791970, 1466791970, 1),
(11, 31, 'Đường Ngô Quyền', '', '', 8, 1, 0, 1466823406, 1466823406, 1),
(12, 32, '< 30(m2)', '30', '<', 1, 1, 0, 1466829216, 1466926183, 1),
(13, 32, '30(m2) - 50(m2)', '30', '50', 2, 1, 0, 1466829254, 1466926192, 1),
(14, 32, '50(m2) - 100(m2)', '50', '100', 3, 1, 0, 1466829282, 1466926258, 1),
(15, 32, '100(m2) - 200(m2)', '100', '200', 4, 1, 0, 1466829378, 1466926266, 1),
(16, 32, '200(m2) - 300(m2)', '200', '300', 5, 1, 0, 1466829387, 1466926273, 1),
(17, 32, '300(m2) - 400(m2)', '300', '400', 6, 1, 0, 1466829435, 1466926281, 1),
(18, 32, '400(m2) - 500(m2)', '400', '500', 7, 1, 0, 1466829449, 1466926342, 1),
(19, 32, '> 500(m2)', '500', '>', 8, 1, 0, 1466829459, 1466926350, 1),
(20, 33, 'Liên hệ', '0', '', 1, 1, 0, 1466829501, 1466926395, 1),
(21, 33, '< 500 triệu', '500000000', '<', 2, 1, 0, 1466829530, 1466926456, 1),
(22, 33, '500 - 800 triệu', '500000000', '800000000', 3, 1, 0, 1466829564, 1466926541, 1),
(23, 33, '800 - 1 tỷ', '800000000', '1000000000', 4, 1, 0, 1466829591, 1466926564, 1),
(24, 33, '1 - 2 tỷ', '1000000000', '2000000000', 5, 1, 0, 1466829609, 1466829609, 1),
(25, 33, '2 - 3 tỷ', '2000000000', '3000000000', 6, 1, 0, 1466829618, 1466829618, 1),
(26, 33, '3 - 4 tỷ', '3000000000', '4000000000', 7, 1, 0, 1466829634, 1466829634, 1),
(27, 33, '4 - 5 tỷ', '4000000000', '5000000000', 8, 1, 0, 1466829645, 1466829645, 1),
(28, 33, '5 - 7 tỷ', '5000000000', '7000000000', 9, 1, 0, 1466829669, 1466829669, 1),
(29, 33, '7 - 10 tỷ', '7000000000', '10000000000', 10, 1, 0, 1466829679, 1466829679, 1),
(30, 33, '10 - 20 tỷ', '10000000000', '20000000000', 11, 1, 0, 1466829689, 1466829712, 1),
(31, 33, '> 20 tỷ', '20000000000', '>', 12, 1, 0, 1466829722, 1466829722, 1),
(32, 31, 'Đường Nguyễn Xí', '', '', 9, 1, 0, 1466838801, 1466838801, 1),
(33, 34, 'Tây Nam', '', '', 1, 1, 0, 1466951550, 1466951550, 1),
(34, 34, 'Đông Bắc', '', '', 2, 1, 0, 1466951559, 1466951559, 1),
(35, 1, 'Đông', '', '', 1, 1, 0, 1470944864, 1470944864, 1),
(36, 1, 'Tây', '', '', 2, 1, 0, 1470944869, 1470944869, 1),
(37, 1, 'Nam', '', '', 3, 1, 0, 1470944874, 1470944874, 1),
(38, 1, 'Bắc', '', '', 4, 1, 0, 1470944879, 1470944879, 1),
(39, 1, 'Đông Nam', '', '', 5, 1, 0, 1470944885, 1470944885, 1),
(40, 1, 'Đông Bắc', '', '', 6, 1, 0, 1470944891, 1470944891, 1),
(41, 1, 'Tây Nam', '', '', 7, 1, 0, 1470944897, 1470944897, 1),
(42, 1, 'Tây Bắc', '', '', 8, 1, 0, 1470944905, 1470944905, 1);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_others_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_others_menu` (
`others_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `plus` varchar(255) NOT NULL,
  `menu` int(1) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `olala3w_others_menu`
--

INSERT INTO `olala3w_others_menu` (`others_menu_id`, `category_id`, `name`, `slug`, `plus`, `menu`, `parent`, `sort`, `is_active`, `hot`, `created_time`, `modified_time`, `user_id`) VALUES
(1, 88, 'Hướng', 'huong', '', 0, 0, 1, 1, 0, 1470944854, 1470944854, 1);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_page`
--

CREATE TABLE IF NOT EXISTS `olala3w_page` (
`page_id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `content` longtext NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `olala3w_page`
--

INSERT INTO `olala3w_page` (`page_id`, `alias`, `name`, `comment`, `content`, `is_active`, `views`, `modified_time`, `user_id`) VALUES
(27, 'copyright', 'Copyright', '', '<h4>e-Learning</h4>\r\n\r\n<p>CỤC CÔNG NGHỆ THÔNG TIN - TRUNG TÂM 3</p>\r\n\r\n<p><em>Điện thoại:</em> 0511 3 000 001 - <em>Email:</em> info@e-learning.com<br />\r\n<em>Địa chỉ:</em> 32A Tiểu La, quận Hải Châu, thành phố Đà Nẵng</p>\r\n\r\n<p>Copyright © 2016 e-Learning,&nbsp;All rights reserved.</p>\r\n', 1, 1, 1476985202, 1),
(104, 'contact', 'Liên hệ', '', '<h4>Liên hệ</h4>\r\n\r\n<p class="hotline"><i class="fa fa-phone">&nbsp;</i>0905 371 937<br />\r\n(7h00 - 20h00 các ngày trong tuần)</p>\r\n\r\n<p class="mail"><i class="fa fa-envelope">&nbsp;</i>support@e-learning.com</p>\r\n\r\n<p>32A Tiểu La, Q. Hải Châu, TP. Đà Nẵng</p>\r\n', 1, 1, 1476988140, 1),
(105, 'banner', 'Quảng cáo', '', '<div class="img"><img alt="" src="/uploads/images/site/banner.png"></div>\r\n', 1, 1, 1482096409, 1);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_prjname`
--

CREATE TABLE IF NOT EXISTS `olala3w_prjname` (
`prjname_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_product`
--

CREATE TABLE IF NOT EXISTS `olala3w_product` (
`product_id` int(11) NOT NULL,
  `product_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `img_note` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `content` text NOT NULL,
  `trainers` int(11) NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `vote` double NOT NULL DEFAULT '4',
  `click_vote` double NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `olala3w_product`
--

INSERT INTO `olala3w_product` (`product_id`, `product_menu_id`, `name`, `folder`, `img`, `img_note`, `comment`, `content`, `trainers`, `is_active`, `hot`, `views`, `vote`, `click_vote`, `title`, `description`, `keywords`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(5, 249, 'Học lập trình HTML5 từ đầu', '', '7law2tp4ddtt61x-5-hoc-lap-trinh-html5-tu-dau.png', '', 'Như các bạn đã biết, HTML5 là ngôn ngữ cơ bản và phổ biến nhất hiện nay được sử dụng để tạo nên các website hiện đại, thẩm mỹ và phù hợp với các xu hướng thiết kế mới. HTML5 là nền tảng cốt lõi để các nhà cung cấp dịch vụ web mang nội dung, sản phẩm của mình tới tay người dùng trên mọi thiết bị từ PC đến di động mà không cần phải lệ thuộc vào Flash hay các phụ kiện khác.', '', 837, 1, 1, 1, 5, 1, '', '', '', 1477928040, 1, 1478017327, 0),
(6, 242, 'Học lập trình ứng dụng iOS thông qua 10 ứng dụng thiết thực', '', '06ntz6cu7lpy9m9-6-hoc-lap-trinh-ung-dung-ios-thong-qua-10-ung-dung-thiet-thuc.jpg', '', 'Các ứng dụng iOS như Messenger, Music Player... hay Uber, Instagram, Lozi... hoạt đông như thế nào? Khóa học này không những giúp bạn hiểu mà còn giúp bạn tạo ra chúng!', '', 837, 1, 0, 1, 5, 1, '', '', '', 1477928040, 1, 1477928665, 0),
(7, 249, 'Trọn bộ kiến thức về AngularJS trong 6 giờ', '', 'qc79rbvo6zl236g-7-tron-bo-kien-thuc-ve-angularjs-trong-6-gio.png', '', 'Biết về AngularJS giúp bạn có công việc tốt hoặc cải thiện công việc bạn đang có. Đây là kỹ năng cần rất nhiều trong ngành công nghiệp phát triển Web hiện đại. AngularJS giúp bạn tạo các ứng dụng web dễ dàng hơn và đó là lý do tại sao nó trở nên rất phổ biến và được hỗ trợ bởi Google.', '', 836, 1, 0, 1, 5, 1, '', '', '', 1477928700, 1, 1477928725, 0),
(8, 249, 'Làm Website & Landing Page bán hàng, PR, quảng cáo, truyền thông, marketing trong 3 tuần', '', '984eefoiyicsrkr-8-lam-website-landing-page-ban-hang-pr-quang-cao-truyen-thong-marketing-trong-3-tuan.png', '', 'Bạn tò mò về cách tạo ra những trang web có giao diện đẹp mắt, nhiều người truy cập mà bạn vẫn thường vào mỗi ngày? Bạn kinh doanh và muốn tạo ra một trang web để đăng tải thông tin sản phẩm của mình nhưng lại chẳng biết gì về lập trình web? Khóa học "Làm Website & Landing Page bán hàng, PR, quảng cáo, truyền thông, marketing trong 3 tuần" là khóa học bổ ích cung cấp cho bạn những kiến thức nền tảng cần thiết nhất về Internet, làm Web, các loại ngôn ngữ lập trình (HTML, CSS, JS), giới thiệu đến bạn những công cụ phổ biến cũng như những công nghệ làm web mới nhất.', '', 836, 1, 1, 1, 5, 1, '', '', '', 1477928760, 1, 1480266141, 1),
(4, 249, 'Thành thạo Bootstrap qua 10 website và kiếm tiền từ công việc Freelancer', '', '1jersaina2s44hk-4-thanh-thao-bootstrap-qua-10-website-va-kiem-tien-tu-cong-viec-freelancer.png', '', 'Bạn muốn có thể tự làm được trang web cá nhân với đầy đủ hiệu ứng như các giao diện web hiện nay được bày bán. Và cũng tự làm được giao diện web ảnh, tự tạo trang trình bày sản phẩm của mình, tự thiết kế trang blog cho cá nhân, tự làm trang giới thiệu công ty, cửa hàng, dịch vụ với đầy đủ hiệu ứng theo ý mình....', '', 837, 1, 1, 1, 5, 1, '', '', '', 1477927980, 1, 1477928740, 0),
(3, 245, 'Làm chủ Adobe Photoshop CC trong 3 giờ', 'admin\\12-2016\\', 'lam-chu-adobe-photoshop-cc-trong-3-gio-3.jpg', '', 'Các kỹ năng cơ bản sử dụng Photoshop CC', '<p><strong>Làm chủ Adobe Photoshop CC trong 3 giờ</strong></p>\r\n\r\n<p>Làm sao để có những bức ảnh đẹp, được nhiều lượt Like và Comment của bạn bè?</p>\r\n\r\n<p>Làm sao để thiết kế những sản phẩm độc đáo, thể hiện cá tính của bạn?</p>\r\n\r\n<p>Hay chỉ đơn thuần là làm sao để có những banner, poster hỗ trợ đắc lực cho công việc của bạn?</p>\r\n\r\n<p>Bạn muốn tự mình làm được tất cả những điều trên?</p>\r\n\r\n<p>Khóa học "Làm chủ Photoshop CC trong 3 giờ" sẽ giúp bạn những kỹ năng, thao tác cần thiết nhất để làm chủ Adobe Photoshop CC</p>\r\n\r\n<p>Bạn sẽ được:</p>\r\n\r\n<p>- Hướng dẫn cụ thể, step by step</p>\r\n\r\n<p>- Học ít - vận dụng được nhiều.</p>\r\n\r\n<p>- Cung cấp đầy đủ ví dụ để học - Thực hành ngay</p>\r\n\r\n<p>Hãy áp dụng kiến thức bạn học trong 30 phút mỗi ngày, bạn sẽ thấy trình độ của mình cải thiện đáng kể!</p>\r\n\r\n<p><strong>Yêu cầu của khóa học</strong></p>\r\n\r\n<p>- Môi trường học yên tĩnh</p>\r\n\r\n<p>- Có khả năng truy cập Internet</p>\r\n\r\n<p>- Nên sử dụng tai nghe trong quá trình học</p>\r\n\r\n<p>- Khuyến khích cài đặt và sử dụng phần mềm Adobe Photoshop CC 2015</p>\r\n\r\n<p><strong>Lợi ích từ khóa học</strong></p>\r\n\r\n<p>- Học PTS CC bài bản ngay từ đầu</p>\r\n\r\n<p>- Thiết kế được những banner, poster cho web hoặc các sự kiện</p>\r\n\r\n<p>- Làm cho bức ảnh của bạn trông sống động, sắc nét và có chiều sâu</p>\r\n\r\n<p>- Có nền tảng kiến thức cơ bản để tạo ra nhiều sản phẩm Photoshop nâng cao và sáng tạo hơn</p>\r\n\r\n<p>- Nâng kỹ năng sáng tạo của bạn lên một cấp độ mới</p>\r\n\r\n<p>- Thực hành các bài tập cần thiết để trở thành nhà thiết kế chuyên nghiệp</p>\r\n\r\n<p><strong>Đối tượng mục tiêu</strong></p>\r\n\r\n<p>Khóa học này đặc biệt hữu ích với:</p>\r\n\r\n<p>- Những người bắt đầu học desigh nói chung, mới học PTS nói riêng</p>\r\n\r\n<p>- Phóng viên chuyên đưa tin, đăng bài về sự kiện, cần hình ảnh để minh họa cho bài viết</p>\r\n\r\n<p>- Nhân viên marketing, nhân viên truyền thông thương hiệu, nếu biết đồ họa sẽ giúp bạn gây ấn tượng tốt khi giới thiệu sản phẩm của mình</p>\r\n\r\n<p>- Những người muốn tự mình có bức ảnh đẹp nhưng không biết chỉnh sửa ảnh cũng như các thao tác đồ họa khác</p>\r\n\r\n<p>- Những người muốn thiết kế những ấn phẩm đẹp, ý nghĩa để giành tặng người thân, bạn bè trong những dịp đặc biệt</p>\r\n', 837, 1, 1, 1, 9, 3, '', '', '', 1477271700, 1, 1480615250, 1);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_product_like`
--

CREATE TABLE IF NOT EXISTS `olala3w_product_like` (
`product_like_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `olala3w_product_like`
--

INSERT INTO `olala3w_product_like` (`product_like_id`, `product_id`, `user_id`, `created_time`) VALUES
(7, 3, 1, 1478790862),
(8, 8, 1, 1478799084),
(16, 7, 1, 1478805454),
(18, 6, 1, 1478805456);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_product_logs`
--

CREATE TABLE IF NOT EXISTS `olala3w_product_logs` (
`product_logs_id` double NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `olala3w_product_logs`
--

INSERT INTO `olala3w_product_logs` (`product_logs_id`, `product_id`, `user_id`, `created_time`) VALUES
(15, 3, 1, 1477627330),
(16, 5, 1, 1478798490),
(17, 6, 1, 1480255667),
(18, 4, 1, 1480255675),
(19, 7, 1, 1480255689),
(20, 8, 1, 1480255700),
(21, 3, 25, 1483524425);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_product_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_product_menu` (
`product_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT 'not-found',
  `plus` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `folder` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT '-no-',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=266 ;

--
-- Dumping data for table `olala3w_product_menu`
--

INSERT INTO `olala3w_product_menu` (`product_menu_id`, `category_id`, `name`, `slug`, `plus`, `icon`, `title`, `description`, `keywords`, `parent`, `sort`, `is_active`, `hot`, `folder`, `img`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(234, 89, 'Ngoại Ngữ', 'ngoai-ngu', '', 'mdi-google-translate', '', '', '', 0, 5, 1, 0, '', '-no-', 1476329799, 1, 1477534544, 0),
(235, 89, 'Thiết kế', 'thiet-ke', '', 'mdi-palette', '', '', '', 0, 6, 1, 0, '', '-no-', 1476329809, 1, 1477534380, 0),
(232, 89, 'Phát triển cá nhân', 'phat-trien-ca-nhan', '', 'mdi-nature-people', '', '', '', 0, 3, 1, 0, '', '-no-', 1476329779, 1, 1477534062, 0),
(233, 89, 'Kinh doanh và khởi nghiệp', 'kinh-doanh-va-khoi-nghiep', '', 'mdi-bank', '', '', '', 0, 4, 1, 0, '', '-no-', 1476329789, 1, 1477534870, 0),
(230, 89, 'Công nghệ thông tin', 'cong-nghe-thong-tin', '', 'mdi-desktop-mac', '', '', '', 0, 1, 1, 0, '', '-no-', 1476329750, 1, 1477559192, 0),
(231, 89, 'Nuôi dạy con', 'nuoi-day-con', '', 'mdi-human-child', '', '', '', 0, 2, 1, 0, '', '-no-', 1476329760, 1, 1477534040, 0),
(236, 89, 'Marketing', 'marketing', '', 'mdi-voice', '', '', '', 0, 7, 1, 0, '', '-no-', 1476329817, 1, 1477534444, 0),
(237, 89, 'Ứng dụng văn phòng', 'ung-dung-van-phong', '', 'mdi-book-open', '', '', '', 0, 8, 1, 0, '', '-no-', 1476329843, 1, 1477534365, 0),
(238, 89, 'Chủ đề khác', 'chu-de-khac', '', 'mdi-tag-multiple', '', '', '', 0, 9, 1, 0, '', '-no-', 1476329852, 1, 1477534426, 0),
(239, 89, 'Mạng máy tính', 'mang-may-tinh', '', '', '', '', '', 230, 1, 1, 0, '', '-no-', 1476329871, 1, 1476502975, 0),
(240, 89, 'Bảo mật hệ thống', 'bao-mat-he-thong', '', '', '', '', '', 230, 2, 1, 0, '', '-no-', 1476329881, 1, 1476463040, 0),
(241, 89, 'Phần mềm ứng dụng', 'phan-mem-ung-dung', '', '', '', '', '', 230, 3, 1, 0, '', '-no-', 1476329897, 1, 1476463040, 0),
(242, 89, 'Ứng dụng di động', 'ung-dung-di-dong', '', '', '', '', '', 230, 4, 1, 0, '', '-no-', 1476329907, 1, 1476463041, 0),
(245, 89, 'Thiết kế đồ họa', 'thiet-ke-do-hoa', '', '', '', '', '', 230, 5, 1, 0, '', '-no-', 1476902945, 1, 1477061198, 0),
(249, 89, 'Thiết kế Website', 'thiet-ke-website', '', '', '', '', '', 230, 6, 1, 0, '', '-no-', 1477927969, 1, 1477927969, 0),
(254, 89, 'Level 1.1.1', 'level-1-1-1', '', '', '', '', '', 239, 1, 1, 0, '', '-no-', 1478537583, 1, 1478537583, 0),
(255, 89, 'Level 1.1.2', 'level-1-1-2', '', '', '', '', '', 239, 2, 1, 0, '', '-no-', 1478537594, 1, 1478537594, 0),
(256, 89, 'Level 1.1.1.1', 'level-1-1-1-1', '', '', '', '', '', 254, 1, 1, 0, '', '-no-', 1478537606, 1, 1478537606, 0),
(257, 89, 'Level 1.1.1.2', 'level-1-1-1-2', '', '', '', '', '', 254, 2, 1, 0, '', '-no-', 1478537624, 1, 1478537624, 0),
(258, 89, 'Menu 1.1', 'menu-1-1', '', '', '', '', '', 232, 1, 1, 0, '', '-no-', 1478717515, 1, 1478717515, 0),
(259, 89, 'Menu 1.2', 'menu-1-2', '', '', '', '', '', 232, 2, 1, 0, '', '-no-', 1478717522, 1, 1478717522, 0),
(260, 89, 'Menu 1.1.1', 'menu-1-1-1', '', '', '', '', '', 258, 1, 1, 0, '', '-no-', 1478717531, 1, 1478717531, 0),
(261, 89, 'Menu 1.1.2', 'menu-1-1-2', '', '', '', '', '', 258, 2, 1, 0, '', '-no-', 1478717539, 1, 1478717539, 0),
(262, 89, 'Học lập trình HTML5 từ đầu', 'hoc-lap-trinh-html5-tu-dau', '', '', '', '', '', 256, 1, 1, 0, '', '-no-', 1478718664, 1, 1478718664, 0),
(263, 89, 'Làm chủ Adobe Photoshop CC trong 3 giờ', 'lam-chu-adobe-photoshop-cc-trong-3-gio', '', '', '', '', '', 256, 2, 1, 0, '', '-no-', 1478719594, 1, 1478719594, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_product_vote`
--

CREATE TABLE IF NOT EXISTS `olala3w_product_vote` (
`product_vote_id` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `vote` int(1) NOT NULL DEFAULT '5',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `olala3w_product_vote`
--

INSERT INTO `olala3w_product_vote` (`product_vote_id`, `product_id`, `vote`, `user_id`, `modified_time`) VALUES
(2, 3, 3, 1, 1483524352),
(3, 3, 1, 25, 1483524428);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_register_email`
--

CREATE TABLE IF NOT EXISTS `olala3w_register_email` (
`register_email_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_register_try`
--

CREATE TABLE IF NOT EXISTS `olala3w_register_try` (
`register_try_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL DEFAULT 'no-name',
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT 'no-address',
  `note` text NOT NULL,
  `created_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_road`
--

CREATE TABLE IF NOT EXISTS `olala3w_road` (
`road_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_street`
--

CREATE TABLE IF NOT EXISTS `olala3w_street` (
`street_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_test`
--

CREATE TABLE IF NOT EXISTS `olala3w_test` (
`test_id` int(11) NOT NULL,
  `courses_id` int(11) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `olala3w_test`
--

INSERT INTO `olala3w_test` (`test_id`, `courses_id`, `content`, `type`, `sort`, `is_active`, `created_time`, `user_id`, `modified_time`, `modified_user`) VALUES
(8, 3, '<p>Câu thứ nhất.</p>\r\n', 0, 1, 1, 1477490987, 1, 1480086473, 1),
(9, 3, '<p>Câu thứ hai.</p>\r\n', 0, 2, 1, 1477491271, 1, 1477491271, 0),
(10, 3, '<p>Câu thứ ba.</p>\r\n', 0, 3, 1, 1477494040, 1, 1477494040, 0),
(11, 3, '<p>Câu tự luận...</p>\r\n', 1, 4, 1, 1477508779, 1, 1477508779, 0);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_test_logs`
--

CREATE TABLE IF NOT EXISTS `olala3w_test_logs` (
`test_logs_id` double NOT NULL,
  `courses_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `count_correct` int(11) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `olala3w_test_logs`
--

INSERT INTO `olala3w_test_logs` (`test_logs_id`, `courses_id`, `user_id`, `count_correct`, `created_time`) VALUES
(23, 3, 1, 3, 1477627823),
(24, 3, 1, 0, 1477847358);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_tour`
--

CREATE TABLE IF NOT EXISTS `olala3w_tour` (
`tour_id` int(11) NOT NULL,
  `tour_menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `img_note` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `tour_keys` varchar(255) NOT NULL,
  `price` bigint(15) NOT NULL DEFAULT '0',
  `date_schedule` varchar(255) NOT NULL,
  `date_departure` int(11) NOT NULL DEFAULT '0',
  `means` varchar(255) NOT NULL,
  `tour_type` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `sale` int(3) NOT NULL DEFAULT '0',
  `schedule` text NOT NULL,
  `price_list_service` text NOT NULL,
  `upload_id` bigint(20) NOT NULL,
  `maps` text NOT NULL,
  `video` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `pin` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_tour_menu`
--

CREATE TABLE IF NOT EXISTS `olala3w_tour_menu` (
`tour_menu_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT 'not-found',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `img` varchar(255) NOT NULL DEFAULT 'no',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=157 ;

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_uploads_tmp`
--

CREATE TABLE IF NOT EXISTS `olala3w_uploads_tmp` (
`upload_id` bigint(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `list_img` text NOT NULL,
  `created_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1595 ;

--
-- Dumping data for table `olala3w_uploads_tmp`
--

INSERT INTO `olala3w_uploads_tmp` (`upload_id`, `status`, `list_img`, `created_time`) VALUES
(670, 1, '', 1435166069),
(671, 1, '', 1435166233),
(672, 1, '', 1435166690),
(697, 1, '', 1435864239),
(725, 1, '', 1437032394),
(677, 1, '', 1435714961),
(681, 1, '', 1435719594),
(719, 1, '', 1437031094),
(685, 1, '', 1435761258),
(687, 1, '', 1435788006),
(695, 1, '', 1435863876),
(729, 1, '', 1437034680),
(693, 1, '', 1435848070),
(650, 1, '', 1434352705),
(651, 1, '', 1434383172),
(652, 1, '', 1434386825),
(679, 1, '', 1435718549),
(657, 1, '', 1434937452),
(619, 1, '', 1433263662),
(620, 1, '', 1433268965),
(621, 1, '', 1433269022),
(622, 1, '', 1433277252),
(623, 1, '', 1433277326),
(626, 1, '', 1433432146),
(627, 1, '', 1433437322),
(628, 1, '', 1433437357),
(629, 1, '', 1433438164),
(630, 1, '', 1433438567),
(631, 1, '', 1433438885),
(632, 1, '', 1433440549),
(633, 1, '', 1433443144),
(636, 1, '', 1433521782),
(709, 1, '', 1437029348),
(731, 1, '', 1437035064),
(739, 1, '', 1437037049),
(743, 1, '', 1437059539),
(745, 1, '', 1437060786),
(751, 1, '', 1437094949),
(757, 1, '', 1437121876),
(759, 1, '', 1437123075),
(761, 1, '', 1437123431),
(767, 1, '', 1437205996),
(809, 1, '', 1437470528),
(769, 1, '', 1437206993),
(771, 1, '', 1437207296),
(773, 1, '', 1437207988),
(775, 1, '', 1437208534),
(777, 1, '', 1437208892),
(779, 1, '', 1437209307),
(781, 1, '', 1437209548),
(783, 1, '', 1437210581),
(785, 1, '', 1437210936),
(787, 1, '', 1437212715),
(789, 1, '', 1437213057),
(791, 1, '', 1437213776),
(793, 1, '', 1437214398),
(837, 1, '', 1439225251),
(795, 1, '', 1437214924),
(805, 1, '', 1437465377),
(804, 1, '', 1437465192),
(824, 1, '', 1438162290),
(843, 1, '', 1445272671),
(844, 1, '', 1445274723),
(846, 1, '', 1445390586),
(847, 1, '', 1445390606),
(853, 1, '', 1445395492),
(852, 1, '', 1445395479),
(851, 1, '', 1445395465),
(854, 1, '', 1445395505),
(855, 1, '', 1445404573),
(1248, 0, '', 1457514176),
(1249, 0, '', 1457514204),
(1250, 0, '', 1457514592),
(1251, 0, '', 1457514927),
(1252, 0, '', 1457514941),
(1253, 0, '', 1457514966),
(1254, 0, '', 1457514977),
(1, 1, '', 1435166060),
(1255, 0, '', 1457515085),
(3, 1, '', 1435166060),
(8, 1, '', 1435166060),
(9, 1, '', 1435166060),
(11, 1, '', 1435166060),
(1256, 0, '', 1457515140),
(1257, 0, '', 1457515142),
(1258, 0, '', 1457515509),
(1247, 0, '', 1457514156),
(1378, 0, '', 1461782168),
(1382, 0, '', 1462697848),
(1428, 0, '', 1466787889),
(1259, 0, '', 1457515511),
(1260, 0, '', 1457515619),
(1261, 0, '', 1457515691),
(1262, 0, '', 1457515721),
(1263, 0, '', 1457515746),
(1264, 0, '', 1457515769),
(1265, 0, '', 1457515790),
(1266, 0, '', 1457515888),
(1267, 0, '', 1457515921),
(1268, 0, '', 1457515926),
(1269, 0, '', 1457515986),
(1270, 0, '', 1457516002),
(1271, 0, '', 1457516083),
(1272, 0, '', 1457516092),
(1273, 0, '', 1457516598),
(1277, 0, '', 1457520165),
(1278, 0, '', 1457522217),
(1242, 0, '1457509775_1242_b550267eb25f7b9d1039b3b0e5de04b4.jpg;1457509776_1242_1dfe4da1ad23f6214650710814d6949c.jpg;', 1457507790),
(1245, 0, '', 1457511233),
(1322, 0, '', 1458980293),
(1324, 0, '', 1458980700),
(1335, 0, '', 1459069472),
(1282, 0, '', 1457524595),
(1386, 0, '', 1462906162),
(1388, 0, '', 1462907487),
(1389, 0, '', 1462907565),
(1427, 0, '', 1464596170),
(1402, 0, '', 1463601350),
(1396, 0, '', 1463282752),
(1432, 0, '', 1466793079),
(1431, 0, '', 1466793018),
(1430, 0, '', 1466789081),
(1429, 0, '', 1466789039),
(1315, 0, '', 1458974205),
(1316, 0, '', 1458974577),
(1318, 0, '', 1458975857),
(1358, 0, '', 1461518514),
(1311, 0, '', 1458961596),
(1310, 0, '', 1458961578),
(1291, 0, '', 1457541068),
(1292, 0, '', 1457542951),
(1307, 0, '', 1457602309),
(1308, 0, '', 1457607431),
(1343, 0, '', 1460112871),
(1345, 0, '', 1460133591),
(1346, 0, '', 1460133615),
(1347, 0, '', 1460133634),
(1348, 0, '', 1460133669),
(1349, 0, '', 1460133765),
(1350, 0, '', 1460133808),
(1356, 0, '', 1460137789),
(1352, 0, '', 1460134207),
(1357, 0, '', 1461089004),
(1442, 0, '', 1466950508),
(1443, 0, '', 1466950811),
(1444, 0, '', 1466950823),
(1445, 0, '', 1466950972),
(1447, 0, '', 1466951493),
(1433, 0, '', 1466793085),
(1434, 0, '', 1466793095),
(1435, 0, '', 1466793126),
(1436, 0, '', 1466793203),
(1437, 0, '', 1466793408),
(1438, 0, '', 1466793436),
(1439, 0, '', 1466793607),
(1440, 1, '', 1466793616),
(1441, 1, '1466881029_1441_9c2277a499a4b58a1c23ba0d3e53086d.jpg;1466881030_1441_e9c527a904d913ec5be77670915c73df.jpg;1466881031_1441_fd15ede55a26ed56029dc34ab5eb330a.jpg;1466881032_1441_04ae499c30862f82cbfee7292ff088ca.jpg;1466881033_1441_72bd9f94ca2bbf7f8022d974adc7f7ad.jpg;1466881035_1441_36eb7a500e494e7a8c88e91a33212b2d.jpg;1466881036_1441_9afc90319687e8b63d7d9dba741a4554.jpg;1466881037_1441_1e14a63be04cf9730ecbd83966cefcaf.png;1466881038_1441_8e694e6766382d06a0ce2ee83542cbf8.jpg;1466881039_1441_b0d90029a5b01190227900c583fd3df9.jpg;1466881041_1441_7889989a8d90281378884edfce66c8fb.jpg;1466881042_1441_44ed57b417b86c0a479e379201f3d98c.jpg;', 1466838544),
(1449, 0, '', 1470650300),
(1528, 0, '', 1476343271),
(1527, 0, '', 1476331955),
(1454, 0, '', 1470848719),
(1526, 0, '', 1476297261),
(1460, 0, '', 1470853758),
(1463, 0, '', 1470936296),
(1464, 0, '', 1470937411),
(1465, 0, '', 1470937738),
(1466, 0, '', 1470938374),
(1467, 0, '', 1470938799),
(1468, 0, '', 1470939173),
(1469, 0, '', 1470939481),
(1470, 0, '', 1470939512),
(1471, 0, '', 1470939584),
(1472, 0, '', 1470939607),
(1473, 0, '', 1470939622),
(1474, 0, '', 1470939625),
(1475, 0, '', 1470939684),
(1476, 0, '', 1470939920),
(1477, 0, '', 1470939938),
(1478, 0, '', 1470939984),
(1479, 0, '', 1470940002),
(1480, 0, '', 1470940012),
(1481, 0, '', 1470940161),
(1482, 0, '', 1470940387),
(1483, 0, '', 1470940400),
(1484, 0, '', 1470940461),
(1485, 0, '', 1470940549),
(1510, 0, '', 1471531448),
(1496, 0, '', 1471417539),
(1590, 0, '', 1481652462),
(1589, 1, '', 1480867030),
(1587, 1, '', 1480263568),
(1569, 1, '', 1476976905),
(1570, 1, '', 1476977032),
(1571, 1, '', 1476977114),
(1572, 1, '', 1476977139),
(1573, 1, '', 1476983508),
(1574, 0, '', 1477073535),
(1575, 0, '', 1477073597),
(1576, 0, '', 1477073665),
(1578, 0, '', 1477539871),
(1580, 0, '', 1477562090),
(1581, 0, '', 1477562166),
(1582, 0, '', 1477563181),
(1583, 0, '', 1477563547),
(1584, 0, '', 1478006333),
(1585, 0, '', 1479755357),
(1591, 0, '', 1481652584),
(1592, 1, '', 1481652597),
(1593, 1, '', 1481653321),
(1594, 1, '', 1481653465),
(1515, 0, '', 1471532514),
(1517, 0, '', 1471535582),
(1518, 0, '', 1471538597),
(1529, 0, '', 1476345563),
(1530, 0, '', 1476345582),
(1531, 0, '', 1476345710),
(1532, 0, '', 1476345722),
(1533, 0, '', 1476345817),
(1534, 0, '', 1476345827),
(1535, 0, '', 1476347425),
(1536, 0, '', 1476370331),
(1538, 0, '', 1476376818),
(1539, 0, '', 1476376893),
(1540, 0, '', 1476376960),
(1565, 1, '', 1476496224),
(1564, 1, '', 1476495960),
(1563, 0, '', 1476462505),
(1544, 0, '', 1476379405),
(1545, 0, '', 1476379408),
(1546, 0, '', 1476379411),
(1547, 0, '', 1476379415),
(1548, 0, '', 1476379417),
(1549, 0, '', 1476379434),
(1550, 0, '', 1476379437),
(1551, 0, '', 1476379482),
(1552, 0, '', 1476379485),
(1553, 0, '', 1476379497),
(1554, 0, '', 1476379501),
(1561, 0, '', 1476451978),
(1560, 1, '', 1476437660);

-- --------------------------------------------------------

--
-- Table structure for table `olala3w_vote`
--

CREATE TABLE IF NOT EXISTS `olala3w_vote` (
`vote_id` bigint(20) NOT NULL,
  `session` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `vote` int(1) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `olala3w_answer`
--
ALTER TABLE `olala3w_answer`
 ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `olala3w_answer_logs`
--
ALTER TABLE `olala3w_answer_logs`
 ADD PRIMARY KEY (`answer_logs_id`);

--
-- Indexes for table `olala3w_article`
--
ALTER TABLE `olala3w_article`
 ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `olala3w_article_menu`
--
ALTER TABLE `olala3w_article_menu`
 ADD PRIMARY KEY (`article_menu_id`);

--
-- Indexes for table `olala3w_bds_business`
--
ALTER TABLE `olala3w_bds_business`
 ADD PRIMARY KEY (`bds_business_id`);

--
-- Indexes for table `olala3w_bds_business_menu`
--
ALTER TABLE `olala3w_bds_business_menu`
 ADD PRIMARY KEY (`bds_business_menu_id`);

--
-- Indexes for table `olala3w_car`
--
ALTER TABLE `olala3w_car`
 ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `olala3w_car_menu`
--
ALTER TABLE `olala3w_car_menu`
 ADD PRIMARY KEY (`car_menu_id`);

--
-- Indexes for table `olala3w_category`
--
ALTER TABLE `olala3w_category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `olala3w_category_type`
--
ALTER TABLE `olala3w_category_type`
 ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `olala3w_constant`
--
ALTER TABLE `olala3w_constant`
 ADD PRIMARY KEY (`constant_id`);

--
-- Indexes for table `olala3w_contact`
--
ALTER TABLE `olala3w_contact`
 ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `olala3w_core_privilege`
--
ALTER TABLE `olala3w_core_privilege`
 ADD PRIMARY KEY (`privilege_id`);

--
-- Indexes for table `olala3w_core_role`
--
ALTER TABLE `olala3w_core_role`
 ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `olala3w_core_user`
--
ALTER TABLE `olala3w_core_user`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `olala3w_courses`
--
ALTER TABLE `olala3w_courses`
 ADD PRIMARY KEY (`courses_id`);

--
-- Indexes for table `olala3w_courses_logs`
--
ALTER TABLE `olala3w_courses_logs`
 ADD PRIMARY KEY (`courses_logs_id`);

--
-- Indexes for table `olala3w_direction`
--
ALTER TABLE `olala3w_direction`
 ADD PRIMARY KEY (`direction_id`);

--
-- Indexes for table `olala3w_discussion`
--
ALTER TABLE `olala3w_discussion`
 ADD PRIMARY KEY (`discussion_id`);

--
-- Indexes for table `olala3w_document`
--
ALTER TABLE `olala3w_document`
 ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `olala3w_document_menu`
--
ALTER TABLE `olala3w_document_menu`
 ADD PRIMARY KEY (`document_menu_id`);

--
-- Indexes for table `olala3w_forum`
--
ALTER TABLE `olala3w_forum`
 ADD PRIMARY KEY (`forum_id`);

--
-- Indexes for table `olala3w_forum_comment`
--
ALTER TABLE `olala3w_forum_comment`
 ADD PRIMARY KEY (`forum_comment_id`);

--
-- Indexes for table `olala3w_forum_like`
--
ALTER TABLE `olala3w_forum_like`
 ADD PRIMARY KEY (`forum_like_id`);

--
-- Indexes for table `olala3w_forum_menu`
--
ALTER TABLE `olala3w_forum_menu`
 ADD PRIMARY KEY (`forum_menu_id`);

--
-- Indexes for table `olala3w_gallery`
--
ALTER TABLE `olala3w_gallery`
 ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `olala3w_gallery_menu`
--
ALTER TABLE `olala3w_gallery_menu`
 ADD PRIMARY KEY (`gallery_menu_id`);

--
-- Indexes for table `olala3w_gift`
--
ALTER TABLE `olala3w_gift`
 ADD PRIMARY KEY (`gift_id`);

--
-- Indexes for table `olala3w_gift_menu`
--
ALTER TABLE `olala3w_gift_menu`
 ADD PRIMARY KEY (`gift_menu_id`);

--
-- Indexes for table `olala3w_location`
--
ALTER TABLE `olala3w_location`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `olala3w_location_menu`
--
ALTER TABLE `olala3w_location_menu`
 ADD PRIMARY KEY (`location_menu_id`);

--
-- Indexes for table `olala3w_notify`
--
ALTER TABLE `olala3w_notify`
 ADD PRIMARY KEY (`notify_id`);

--
-- Indexes for table `olala3w_notify_logs`
--
ALTER TABLE `olala3w_notify_logs`
 ADD PRIMARY KEY (`notify_logs_id`);

--
-- Indexes for table `olala3w_notify_status`
--
ALTER TABLE `olala3w_notify_status`
 ADD PRIMARY KEY (`notify_status_id`);

--
-- Indexes for table `olala3w_online`
--
ALTER TABLE `olala3w_online`
 ADD PRIMARY KEY (`online_id`);

--
-- Indexes for table `olala3w_online_daily`
--
ALTER TABLE `olala3w_online_daily`
 ADD PRIMARY KEY (`online_daily_id`);

--
-- Indexes for table `olala3w_order`
--
ALTER TABLE `olala3w_order`
 ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `olala3w_others`
--
ALTER TABLE `olala3w_others`
 ADD PRIMARY KEY (`others_id`);

--
-- Indexes for table `olala3w_others_menu`
--
ALTER TABLE `olala3w_others_menu`
 ADD PRIMARY KEY (`others_menu_id`);

--
-- Indexes for table `olala3w_page`
--
ALTER TABLE `olala3w_page`
 ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `olala3w_prjname`
--
ALTER TABLE `olala3w_prjname`
 ADD PRIMARY KEY (`prjname_id`);

--
-- Indexes for table `olala3w_product`
--
ALTER TABLE `olala3w_product`
 ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `olala3w_product_like`
--
ALTER TABLE `olala3w_product_like`
 ADD PRIMARY KEY (`product_like_id`);

--
-- Indexes for table `olala3w_product_logs`
--
ALTER TABLE `olala3w_product_logs`
 ADD PRIMARY KEY (`product_logs_id`);

--
-- Indexes for table `olala3w_product_menu`
--
ALTER TABLE `olala3w_product_menu`
 ADD PRIMARY KEY (`product_menu_id`);

--
-- Indexes for table `olala3w_product_vote`
--
ALTER TABLE `olala3w_product_vote`
 ADD PRIMARY KEY (`product_vote_id`);

--
-- Indexes for table `olala3w_register_email`
--
ALTER TABLE `olala3w_register_email`
 ADD PRIMARY KEY (`register_email_id`);

--
-- Indexes for table `olala3w_register_try`
--
ALTER TABLE `olala3w_register_try`
 ADD PRIMARY KEY (`register_try_id`);

--
-- Indexes for table `olala3w_road`
--
ALTER TABLE `olala3w_road`
 ADD PRIMARY KEY (`road_id`);

--
-- Indexes for table `olala3w_street`
--
ALTER TABLE `olala3w_street`
 ADD PRIMARY KEY (`street_id`);

--
-- Indexes for table `olala3w_test`
--
ALTER TABLE `olala3w_test`
 ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `olala3w_test_logs`
--
ALTER TABLE `olala3w_test_logs`
 ADD PRIMARY KEY (`test_logs_id`);

--
-- Indexes for table `olala3w_tour`
--
ALTER TABLE `olala3w_tour`
 ADD PRIMARY KEY (`tour_id`);

--
-- Indexes for table `olala3w_tour_menu`
--
ALTER TABLE `olala3w_tour_menu`
 ADD PRIMARY KEY (`tour_menu_id`);

--
-- Indexes for table `olala3w_uploads_tmp`
--
ALTER TABLE `olala3w_uploads_tmp`
 ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `olala3w_vote`
--
ALTER TABLE `olala3w_vote`
 ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `olala3w_answer`
--
ALTER TABLE `olala3w_answer`
MODIFY `answer_id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `olala3w_answer_logs`
--
ALTER TABLE `olala3w_answer_logs`
MODIFY `answer_logs_id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `olala3w_article`
--
ALTER TABLE `olala3w_article`
MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=852;
--
-- AUTO_INCREMENT for table `olala3w_article_menu`
--
ALTER TABLE `olala3w_article_menu`
MODIFY `article_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=435;
--
-- AUTO_INCREMENT for table `olala3w_bds_business`
--
ALTER TABLE `olala3w_bds_business`
MODIFY `bds_business_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=443;
--
-- AUTO_INCREMENT for table `olala3w_bds_business_menu`
--
ALTER TABLE `olala3w_bds_business_menu`
MODIFY `bds_business_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `olala3w_car`
--
ALTER TABLE `olala3w_car`
MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=312;
--
-- AUTO_INCREMENT for table `olala3w_car_menu`
--
ALTER TABLE `olala3w_car_menu`
MODIFY `car_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=188;
--
-- AUTO_INCREMENT for table `olala3w_category`
--
ALTER TABLE `olala3w_category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `olala3w_category_type`
--
ALTER TABLE `olala3w_category_type`
MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `olala3w_constant`
--
ALTER TABLE `olala3w_constant`
MODIFY `constant_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `olala3w_contact`
--
ALTER TABLE `olala3w_contact`
MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `olala3w_core_privilege`
--
ALTER TABLE `olala3w_core_privilege`
MODIFY `privilege_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4811;
--
-- AUTO_INCREMENT for table `olala3w_core_role`
--
ALTER TABLE `olala3w_core_role`
MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `olala3w_core_user`
--
ALTER TABLE `olala3w_core_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `olala3w_courses`
--
ALTER TABLE `olala3w_courses`
MODIFY `courses_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `olala3w_courses_logs`
--
ALTER TABLE `olala3w_courses_logs`
MODIFY `courses_logs_id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `olala3w_direction`
--
ALTER TABLE `olala3w_direction`
MODIFY `direction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `olala3w_discussion`
--
ALTER TABLE `olala3w_discussion`
MODIFY `discussion_id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `olala3w_document`
--
ALTER TABLE `olala3w_document`
MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `olala3w_document_menu`
--
ALTER TABLE `olala3w_document_menu`
MODIFY `document_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `olala3w_forum`
--
ALTER TABLE `olala3w_forum`
MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=216;
--
-- AUTO_INCREMENT for table `olala3w_forum_comment`
--
ALTER TABLE `olala3w_forum_comment`
MODIFY `forum_comment_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `olala3w_forum_like`
--
ALTER TABLE `olala3w_forum_like`
MODIFY `forum_like_id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `olala3w_forum_menu`
--
ALTER TABLE `olala3w_forum_menu`
MODIFY `forum_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT for table `olala3w_gallery`
--
ALTER TABLE `olala3w_gallery`
MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=614;
--
-- AUTO_INCREMENT for table `olala3w_gallery_menu`
--
ALTER TABLE `olala3w_gallery_menu`
MODIFY `gallery_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `olala3w_gift`
--
ALTER TABLE `olala3w_gift`
MODIFY `gift_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `olala3w_gift_menu`
--
ALTER TABLE `olala3w_gift_menu`
MODIFY `gift_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `olala3w_location`
--
ALTER TABLE `olala3w_location`
MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `olala3w_location_menu`
--
ALTER TABLE `olala3w_location_menu`
MODIFY `location_menu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `olala3w_notify`
--
ALTER TABLE `olala3w_notify`
MODIFY `notify_id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `olala3w_notify_logs`
--
ALTER TABLE `olala3w_notify_logs`
MODIFY `notify_logs_id` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `olala3w_notify_status`
--
ALTER TABLE `olala3w_notify_status`
MODIFY `notify_status_id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `olala3w_online`
--
ALTER TABLE `olala3w_online`
MODIFY `online_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4257;
--
-- AUTO_INCREMENT for table `olala3w_online_daily`
--
ALTER TABLE `olala3w_online_daily`
MODIFY `online_daily_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=508;
--
-- AUTO_INCREMENT for table `olala3w_order`
--
ALTER TABLE `olala3w_order`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `olala3w_others`
--
ALTER TABLE `olala3w_others`
MODIFY `others_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `olala3w_others_menu`
--
ALTER TABLE `olala3w_others_menu`
MODIFY `others_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `olala3w_page`
--
ALTER TABLE `olala3w_page`
MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `olala3w_prjname`
--
ALTER TABLE `olala3w_prjname`
MODIFY `prjname_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `olala3w_product`
--
ALTER TABLE `olala3w_product`
MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `olala3w_product_like`
--
ALTER TABLE `olala3w_product_like`
MODIFY `product_like_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `olala3w_product_logs`
--
ALTER TABLE `olala3w_product_logs`
MODIFY `product_logs_id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `olala3w_product_menu`
--
ALTER TABLE `olala3w_product_menu`
MODIFY `product_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=266;
--
-- AUTO_INCREMENT for table `olala3w_product_vote`
--
ALTER TABLE `olala3w_product_vote`
MODIFY `product_vote_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `olala3w_register_email`
--
ALTER TABLE `olala3w_register_email`
MODIFY `register_email_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `olala3w_register_try`
--
ALTER TABLE `olala3w_register_try`
MODIFY `register_try_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `olala3w_road`
--
ALTER TABLE `olala3w_road`
MODIFY `road_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `olala3w_street`
--
ALTER TABLE `olala3w_street`
MODIFY `street_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `olala3w_test`
--
ALTER TABLE `olala3w_test`
MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `olala3w_test_logs`
--
ALTER TABLE `olala3w_test_logs`
MODIFY `test_logs_id` double NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `olala3w_tour`
--
ALTER TABLE `olala3w_tour`
MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `olala3w_tour_menu`
--
ALTER TABLE `olala3w_tour_menu`
MODIFY `tour_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT for table `olala3w_uploads_tmp`
--
ALTER TABLE `olala3w_uploads_tmp`
MODIFY `upload_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1595;
--
-- AUTO_INCREMENT for table `olala3w_vote`
--
ALTER TABLE `olala3w_vote`
MODIFY `vote_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
