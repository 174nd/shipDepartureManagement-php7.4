/*Table structure for table `ci` */



DROP TABLE IF EXISTS `ci`;



CREATE TABLE `ci` (
  `id_ci` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_ci` date DEFAULT NULL,
  `kd_kapal` varchar(10) DEFAULT NULL,
  `kd_pelabuhan` varchar(10) DEFAULT NULL,
  `tipe_muatan` enum('N','G','T') DEFAULT NULL,
  `jns_muatan` varchar(100) DEFAULT NULL,
  `muatan` varchar(100) DEFAULT NULL,
  `k_muatan` enum('Y','N') DEFAULT NULL,
  `k_ci` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id_ci`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;



/*Data for the table `ci` */



insert  into `ci`(`id_ci`,`tgl_ci`,`kd_kapal`,`kd_pelabuhan`,`tipe_muatan`,`jns_muatan`,`muatan`,`k_muatan`,`k_ci`) values (1,'2020-09-22','K000000001','P000000001','N',NULL,NULL,'Y','Y'),(2,'2020-09-22','K000000002','P000000001','N',NULL,NULL,'Y','Y'),(3,'2020-09-28','K000000003','P000000001','N',NULL,NULL,'Y','Y'),(4,'2020-09-28','K000000004','P000000001','N',NULL,NULL,'Y','Y'),(5,'2020-09-29','K000000005','P000000002','N',NULL,NULL,'Y','Y'),(6,'2020-09-30','K000000006','P000000003','T','507','M.SOLAR','Y','Y'),(7,'2020-10-01','K000000007','P000000004','N',NULL,NULL,'Y','Y'),(8,'2020-10-02','K000000008','P000000005','N',NULL,NULL,'Y','Y'),(9,'2020-10-02','K000000009','P000000005','T','236','BBM','Y','Y'),(10,'2020-10-02','K000000010','P000000006','N',NULL,NULL,'Y','Y'),(11,'2020-10-03','K000000011','P000000005','N',NULL,NULL,'Y','Y'),(12,'2020-10-03','K000000012','P000000005','N',NULL,NULL,'Y','Y'),(13,'2020-10-03','K000000003','P000000001','N',NULL,NULL,'Y','Y'),(14,'2020-10-03','K000000013','P000000001','N',NULL,NULL,'Y','Y'),(15,'2020-10-03','K000000012','P000000004','N',NULL,NULL,'Y','Y'),(16,'2020-10-04','K000000014','P000000007','N',NULL,NULL,'Y','Y'),(17,'2020-10-07','K000000003','P000000001','N',NULL,NULL,'Y','Y'),(18,'2020-10-07','K000000004','P000000001','N',NULL,NULL,'Y','Y'),(19,'2020-10-09','K000000006','P000000003','T','435','M.SOLAR','Y','Y'),(20,'2020-10-12','K000000003','P000000001','N',NULL,NULL,'Y','Y'),(21,'2020-10-12','K000000013','P000000001','N',NULL,NULL,'Y','Y'),(22,'2020-10-12','K000000015','P000000005','N',NULL,NULL,'Y','Y'),(23,'2020-10-12','K000000016','P000000005','N',NULL,NULL,'Y','Y'),(24,'2020-10-16','K000000003','P000000001','N',NULL,NULL,'Y','Y'),(25,'2020-10-16','K000000004','P000000001','N',NULL,NULL,'Y','Y'),(26,'2020-10-17','K000000006','P000000003','T','344','M.SOLAR','Y','Y'),(27,'2020-10-17','K000000017','P000000008','N',NULL,NULL,'Y','Y'),(28,'2020-10-19','K000000008','P000000005','N',NULL,NULL,'Y','Y'),(29,'2020-10-19','K000000009','P000000005','T','168','BBM','Y','Y'),(30,'2020-10-19','K000000018','P000000009','N',NULL,NULL,'Y','Y'),(31,'2020-10-19','K000000019','P000000009','N',NULL,NULL,'Y','Y'),(32,'2020-10-20','K000000007','P000000004','N',NULL,NULL,'Y','Y'),(33,'2020-10-21','K000000003','P000000001','N',NULL,NULL,'Y','Y'),(34,'2020-10-21','K000000013','P000000001','N',NULL,NULL,'Y','Y'),(35,'2020-10-23','K000000006','P000000003','T','435','M.SOLAR','Y','Y'),(36,'2020-10-24','K000000011','P000000004','N',NULL,NULL,'Y','Y'),(37,'2020-10-24','K000000020','P000000004','N',NULL,NULL,'Y','Y'),(38,'2020-10-24','K000000011','P000000004','N',NULL,NULL,'Y','Y'),(39,'2020-10-24','K000000012','P000000005','N',NULL,NULL,'Y','Y'),(40,'2020-08-14','K000000021','P000000005','N',NULL,NULL,'Y','Y'),(41,'2020-10-25','K000000022','P000000005','N',NULL,NULL,'Y','Y'),(42,'2020-10-28','K000000023','P000000001','N',NULL,NULL,'Y','Y'),(43,'2020-10-28','K000000024','P000000001','N',NULL,NULL,'Y','Y'),(44,'2021-05-04','K000000024','P000000002','N',NULL,'asasa','Y','N');



/*Table structure for table `co` */



DROP TABLE IF EXISTS `co`;



CREATE TABLE `co` (
  `id_co` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_co` date DEFAULT NULL,
  `id_ci` int(11) DEFAULT NULL,
  `kd_pelabuhan` varchar(10) DEFAULT NULL,
  `tipe_muatan` enum('N','G','T') DEFAULT NULL,
  `jns_muatan` varchar(100) DEFAULT NULL,
  `muatan` varchar(100) DEFAULT NULL,
  `k_muatan` enum('Y','N') DEFAULT NULL,
  `k_co` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id_co`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;



/*Data for the table `co` */



insert  into `co`(`id_co`,`tgl_co`,`id_ci`,`kd_pelabuhan`,`tipe_muatan`,`jns_muatan`,`muatan`,`k_muatan`,`k_co`) values (1,'2020-10-02',1,'P000000001','N',NULL,NULL,'Y','Y'),(2,'2020-10-02',2,'P000000001','T','337','M.MENTAH','Y','Y'),(3,'2020-10-01',3,'P000000001','N',NULL,NULL,'Y','Y'),(4,'2020-10-01',4,'P000000001','T','1169','M.MENTAH','Y','Y'),(5,'2020-10-24',5,'P000000002','N',NULL,NULL,'Y','Y'),(6,'2020-10-04',6,'P000000003','N',NULL,NULL,'Y','Y'),(7,'2020-10-17',7,'P000000004','G','GANDENG KM.LANCAR REZEKI PRIMA','GT.30','Y','Y'),(8,'2020-10-11',8,'P000000005','N',NULL,NULL,'Y','Y'),(9,'2020-10-11',9,'P000000005','N',NULL,NULL,'Y','Y'),(10,'2020-10-21',11,'P000000004','N',NULL,NULL,'Y','Y'),(11,'2020-10-05',13,'P000000001','N',NULL,NULL,'Y','Y'),(12,'2020-10-05',14,'P000000001','T','1100','M.MENTAH','Y','Y'),(13,'2020-10-27',15,'P000000010','N',NULL,NULL,'Y','Y'),(14,'2020-10-08',16,'P000000001','N',NULL,NULL,'Y','Y'),(15,'2020-10-10',17,'P000000001','N',NULL,NULL,'Y','Y'),(16,'2020-10-10',18,'P000000001','T','1090','M.MENTAH','Y','Y'),(17,'2020-10-12',19,'P000000008','T','100','M.SOLAR','Y','Y'),(18,'2020-10-14',20,'P000000001','N',NULL,NULL,'Y','Y'),(19,'2020-10-14',21,'P000000001','T','1158','M.MENTAH','Y','Y'),(20,'2020-10-19',24,'P000000001','N',NULL,NULL,'Y','Y'),(21,'2020-10-19',25,'P000000001','T','1100','M.MENTAH','Y','Y'),(22,'2020-10-19',26,'P000000003','N',NULL,NULL,'Y','Y'),(23,'2020-10-18',27,'P000000004','G','GANDENG KM.SUPER 66','GT.30','Y','Y'),(24,'2020-10-21',30,'P000000010','N',NULL,NULL,'Y','Y'),(25,'2020-10-21',31,'P000000010','N',NULL,NULL,'Y','Y'),(26,'2020-10-24',33,'P000000001','N',NULL,NULL,'Y','Y'),(27,'2020-10-24',34,'P000000001','T','1032','M.MENTAH','Y','Y'),(28,'2020-10-26',35,'P000000008','T','100','M.SOLAR','Y','Y'),(29,'2020-10-27',38,'P000000010','N',NULL,NULL,'Y','Y'),(30,'2020-10-27',39,'P000000010','N',NULL,NULL,'Y','Y'),(31,'2020-10-27',40,'P000000011','N',NULL,NULL,'Y','Y'),(32,'2020-10-27',41,'P000000011','N',NULL,NULL,'Y','Y'),(33,'2020-10-30',42,'P000000001','N',NULL,NULL,'Y','Y'),(34,'2020-10-30',43,'P000000001','N',NULL,NULL,'Y','Y');



/*Table structure for table `kapal` */



DROP TABLE IF EXISTS `kapal`;



CREATE TABLE `kapal` (
  `kd_kapal` varchar(10) NOT NULL,
  `nm_kapal` varchar(100) DEFAULT NULL,
  `gt_kapal` int(11) DEFAULT NULL,
  `stt_kapal` enum('M','C','K') DEFAULT NULL,
  PRIMARY KEY (`kd_kapal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



/*Data for the table `kapal` */



insert  into `kapal`(`kd_kapal`,`nm_kapal`,`gt_kapal`,`stt_kapal`) values ('K000000001','TB.DAWAS PRATAMA.1601',184,'K'),('K000000002','TK.RAMBA PRATAMA.2301',1854,'K'),('K000000003','TB.DIAS RAYA.VI.NO.6251/IIk\r\n',117,'K'),('K000000004','TK.MULIA.XII.NO.6100/Iik',850,'K'),('K000000005','TB.KP.15.NO.101/GGg\r\n',74,'K'),('K000000006','SPOB.PATRA ZALVA.III.NO.6915/PPm\r\n',525,'K'),('K000000007','KM.MERANTI JAYA.RIU9.NO.153\r\n',6,'K'),('K000000008','TB.JAYA MAJU 88.NO.966/PPe\r\n',15,'K'),('K000000009','TK.DEWI JAYA 88.NO.323/PPh\r\n',75,'K'),('K000000010','KM.VINCEN I NO.281/PPe\r\n',34,'K'),('K000000011','TB.SWISSCO 28.NO.1463/PPe\r\n',71,'K'),('K000000012','TK.CONCORP MERINE.NO.1745/PPm\r\n',1441,'K'),('K000000013','TK.DIAS RAYA.IV.NO.1768/IIk\r\n',785,'K'),('K000000014','TB.PANCARAN.III-515\r\n',141,'K'),('K000000015','TB.KP.03.NO.693/PPe\r\n',59,'K'),('K000000016','TK.ZIVEN STAR.NO.1400/PPm\r\n',1134,'K'),('K000000017','KM.GUEST JML NO.225\r\n',6,'K'),('K000000018','TB.RIZKI JAYA 04.NO.547/PPe\r\n',31,'K'),('K000000019','TK.HI-26.NO.191/PPm\r\n',631,'K'),('K000000020','TK.GN PERKASA.NO.165/PPj\r\n',89,'K'),('K000000021','TB.KENCAN 20.NO.1020/PPe\r\n',33,'K'),('K000000022','TK.VIRGO STAR 03.NO.2758/PPm\r\n',907,'K'),('K000000023','TB.ARIA CITRA.II.NO.1192/L\r\n',169,'K'),('K000000024','OB.ARIA CIRTA.V.NO.1561/IIk\r\n',867,'K');



/*Table structure for table `notifikasi` */



DROP TABLE IF EXISTS `notifikasi`;



CREATE TABLE `notifikasi` (
  `kdn` varchar(10) NOT NULL,
  `jenis` enum('danger','info','warning','success') DEFAULT NULL,
  `dc` enum('alert','callout') DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `head` text,
  `isi` text,
  PRIMARY KEY (`kdn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*Data for the table `notifikasi` */



insert  into `notifikasi`(`kdn`,`jenis`,`dc`,`icon`,`head`,`isi`) values ('NOT01','danger','alert','icon fas fa-exclamation-triangle','Log-In Gagal!','Username / Password Salah!'),('NOT02','danger','alert','icon fas fa-exclamation-triangle','Data Gagal di Input!','Ada kesalahan pada query, Silahkan cek lagi!!'),('NOT03','success','alert','icon fas fa-check','Data Berhasil di Input!','Data berhasil diinput kedalam Database!'),('NOT04','success','alert','icon fas fa-check','Data Berhasil di Ubah!','Data berhasil Diubah dari Database!'),('NOT05','warning','alert','icon fas fa-exclamation-triangle','Data Berhasil di Hapus!','Data berhasil Dibapus dari Database!'),('NOT06','warning','alert','icon fas fa-exclamation-triangle','Warning!','Masukan File!!'),('NOT07','danger','alert','icon fas fa-exclamation-triangle','Warning!','Esktensi File Tidak diperbolehkan!!'),('NOT08','danger','alert','icon fas fa-exclamation-triangle','Kesalahan!','Password yang Anda Masukan Salah!'),('NOT09','danger','alert','icon fas fa-exclamation-triangle','Kesalahan!','Password Baru Berbeda / Tidak Sama!'),('NOT10','warning','alert','icon fas fa-exclamation-triangle','Warning!','NIK Telah Digunakan!'),('NOT11','warning','alert','icon fas fa-exclamation-triangle','Warning!','Username Telah Digunakan!');



/*Table structure for table `pelabuhan` */



DROP TABLE IF EXISTS `pelabuhan`;



CREATE TABLE `pelabuhan` (
  `kd_pelabuhan` varchar(10) NOT NULL,
  `nm_pelabuhan` varchar(100) DEFAULT NULL,
  `stt_pelabuhan` enum('T','L') DEFAULT NULL,
  PRIMARY KEY (`kd_pelabuhan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



/*Data for the table `pelabuhan` */



insert  into `pelabuhan`(`kd_pelabuhan`,`nm_pelabuhan`,`stt_pelabuhan`) values ('P000000001','S.PAKNING\r\n','T'),('P000000002','K.TUNGKAL\r\n','T'),('P000000003','TG.UBAN','T'),('P000000004','TBK\r\n','T'),('P000000005','PKU\r\n','T'),('P000000006','TG.BATU\r\n','T'),('P000000007','BATAM\r\n','T'),('P000000008','TG.SAMAK\r\n','T'),('P000000009','PERAWANG\r\n','T'),('P000000010','K.GAUNG\r\n','T'),('P000000011','P.M.PENYALAI\r\n','T');



/*Table structure for table `user` */



DROP TABLE IF EXISTS `user`;



CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nm_user` varchar(100) DEFAULT NULL,
  `foto_user` text,
  `jabatan_user` varchar(100) DEFAULT NULL,
  `uss` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `akses` enum('operasional','admin','pimpinan') DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;



/*Data for the table `user` */



insert  into `user`(`id_user`,`nm_user`,`foto_user`,`jabatan_user`,`uss`,`pass`,`akses`) values (1,'Admin',NULL,'Admin','admin','admin','admin'),(2,'pimpinan',NULL,'pimpinan','pimpinan','pimpinan','pimpinan'),(3,'operasional',NULL,'operasional','operasional','operasional','operasional');



/*Table structure for table `login` */



DROP TABLE IF EXISTS `login`;



/*!50001 DROP VIEW IF EXISTS `login` */;

/*!50001 DROP TABLE IF EXISTS `login` */;


/*!50001 CREATE TABLE  `login`(
 `id_user` int(11) ,
 `username` varchar(100) ,
 `password` varchar(32) ,
 `akses` enum('operasional','admin','pimpinan') ,
 `nm_user` varchar(100) ,
 `jabatan` varchar(100) ,
 `foto_user` text 
)*/;


/*View structure for view login */



/*!50001 DROP TABLE IF EXISTS `login` */;

/*!50001 DROP VIEW IF EXISTS `login` */;



/*!50001 CREATE VIEW `login` AS (select `user`.`id_user` AS `id_user`,`user`.`uss` AS `username`,md5(`user`.`pass`) AS `password`,`user`.`akses` AS `akses`,`user`.`nm_user` AS `nm_user`,`user`.`jabatan_user` AS `jabatan`,`user`.`foto_user` AS `foto_user` from `user`) */
