DELIMITER ;;
CREATE DEFINER=`music`@`localhost` PROCEDURE `SearchSongs`(IN `searchString` VARCHAR(200), IN `languages` TINYINT)
    SQL SECURITY INVOKER
BEGIN

SELECT distinct s.*
FROM songs s
    LEFT JOIN languages_songs ls ON ls.song_id = s.id
    LEFT JOIN languages l ON l.id = ls.language_id
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
        OR languages = 1 AND l.name = 'English'
        OR languages = 2 AND l.name <> 'English'
        OR languages = 3
    )
ORDER BY s.Title;

END ;;
