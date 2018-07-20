drop table ats_testtask_info;
-- ats_testtask_info
CREATE TABLE `ats_testtask_info` (
  `TaskID` bigint(10) NOT NULL AUTO_INCREMENT,
  `TestImage` varchar(30) DEFAULT NULL,
  `DMIModifyFlag` int(1) DEFAULT NULL,
  `DMI_ProductName` VARCHAR(30) NULL,
  `DMI_PartNumber` varchar(30) DEFAULT NULL,
  `DMI_SerialNumber` varchar(20) DEFAULT NULL,
  `DMI_OEMString` varchar(100) DEFAULT NULL,
  `DMI_SystemConfig` VARCHAR(20) NULL,
  `TestItem` varchar(10) DEFAULT NULL,
  `TestMachine` varchar(30) DEFAULT NULL,
  `MachineID` int(7) DEFAULT NULL,
 -- `PowerID` int(1) DEFAULT NULL,
  -- `LANID` int(1) DEFAULT NULL,
  `SwitchId` int(2) DEFAULT NULL,
  `LANIP` varchar(16) DEFAULT NULL,
  `ShelfID` int(1) DEFAULT NULL,
  `TestResult` varchar(8) DEFAULT NULL,
  `TestResultPath` varchar(40) DEFAULT NULL,
  `TestStartTime` datetime DEFAULT NULL,
  `TestEndTime` datetime DEFAULT NULL,
  `TaskStatus` int(1) DEFAULT NULL,
  `Tester` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`TaskID`),
  UNIQUE KEY `TaskID_UNIQUE` (`TaskID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET='latin1';



-- ats_schedule_info
CREATE TABLE `ats_schedule_info` (
  `TaskID` bigint(10) ,
  `TestImage` varchar(20) DEFAULT NULL,
  `DMIModifyFlag` int(1) DEFAULT NULL,
  `DMI_PartNumber` varchar(20) DEFAULT NULL,
  `DMI_SerialNumber` varchar(20) DEFAULT NULL,
  `DMI_OEMString` varchar(100) DEFAULT NULL,
  `TestItem` varchar(10) DEFAULT NULL,
  `TestMachine` varchar(20) DEFAULT NULL,
  `MachineID` int(7) DEFAULT NULL,
  `PowerID` int(1) DEFAULT NULL,
  `LANID` int(1) DEFAULT NULL,
  `LANIP` varchar(16) DEFAULT NULL,
  `ShelfID` int(1) DEFAULT NULL,
  `TestResult` varchar(8) DEFAULT NULL,
  `TestResultPath` varchar(40) DEFAULT NULL,
  `TestStartTime` datetime DEFAULT NULL,
  `TestEndTime` datetime DEFAULT NULL,
  `TaskStatus` int(1) DEFAULT NULL,
  `Tester` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET='latin1';
# sql
INSERT INTO `tpms`.`ats_testtask_info` (`TaskID`, `TestImage`, `DMIModifyFlag`, `DMI_PartNumber`, `DMI_SerialNumer`, `DMI_OEMString`, `TestItem`, `TestMachine`, `MachineID`, `PowerID`, `LANID`, `LANIP`, `ShelfID`, `TestResult`, `TestResultPath`, `TestStartTime`, `TestEndTime`, `TaskStatus`, `Tester`)
VALUES (NULL, 'TI10661700B', '1', 'PT24C', 'ZD102073H', 'PT24C--ZD', 'JumpStart', 'Altair TX20 CS2 SKU2', '1308044', '1', '1', '1', '1', 'pass', '192.168.10.43//test', '2009-06-08 23:53:17', '2009-06-08 23:53:17', '1', 'Xu.wanliang');

#procedure

CREATE DEFINER=`root`@`localhost` PROCEDURE `new_procedure`()
BEGIN
	declare i int;

    set i=0;
    while i < 900 do
		INSERT INTO `tpms`.`ats_testtask_info` (`TaskID`, `TestImage`, `DMIModifyFlag`, `DMI_PartNumber`, `DMI_SerialNumber`, `DMI_OEMString`, `TestItem`, `TestMachine`, `MachineID`, `PowerID`, `LANID`, `LANIP`, `ShelfID`, `TestResult`, `TestResultPath`, `TestStartTime`, `TestEndTime`, `TaskStatus`, `Tester`)
		VALUES (NULL, 'TI10661700B', '1', 'PT24C', 'ZD102073H', 'PT24C--ZD', 'JumpStart', 'Altair TX20 CS2 SKU2', '1308044', '1', '1', '1', '1', 'pass', '192.168.10.43//test', '2009-06-08 23:53:17', '2009-06-08 23:53:17', '1', 'Xu.wanliang');

	end while;

END

#system_config
CREATE TABLE `tpms`.`ats_system_config` (
  `name` VARCHAR(30) NOT NULL,
  `value` VARCHAR(50) NULL,
  PRIMARY KEY (`name`)) ENGINE=InnoDB DEFAULT CHARSET='latin1';

#reset
update ats_testtask_info set TaskStatus = '0', TestStartTime=NULL where TaskID between 8712116  and 8712129;