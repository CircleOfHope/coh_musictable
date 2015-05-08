--
-- Dumping routines for database 'musictable'
--
/*!50003 DROP PROCEDURE IF EXISTS `SearchSongs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`music`@`localhost` PROCEDURE `SearchSongs`(IN `searchString` VARCHAR(200), IN `languages` TINYINT)
    SQL SECURITY INVOKER
BEGIN

SELECT distinct s.*
FROM songs s
    LEFT JOIN songs_tags st ON st.song_id = s.id
    LEFT JOIN tags t ON t.id = st.tag_id
WHERE
    (
        searchString IS NULL
        OR s.Title LIKE CONCAT('%', searchString, '%')
        OR s.Artist LIKE CONCAT('%', searchString, '%')
        OR s.Scripture LIKE CONCAT('%', searchString, '%')
        OR s.LyricsExcerpt LIKE CONCAT('%', searchString, '%')
        OR s.Notes LIKE CONCAT('%', searchString, '%')
        OR t.Name LIKE CONCAT('%', searchString, '%')
    )
    AND
    (
        languages IS NULL
        OR languages = 1 AND t.name = 'English'
        OR languages = 2 AND t.name = 'Foreign'
        OR languages = 3
    )
ORDER BY s.Title;

END ;;
