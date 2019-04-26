
delimiter //


CREATE TRIGGER danrevi_web.Delete_Unused_Tags
AFTER DELETE ON danrevi_web.article_tag
FOR EACH ROW
BEGIN
DECLARE Tag_Used_Count INT DEFAULT 0;

SELECT COUNT(*) INTO Tag_Used_Count
FROM danrevi_web.article_tag
WHERE tag_id = OLD.tag_id;

IF Tag_Used_Count < 1 THEN
DELETE FROM danrevi_web.tags WHERE id = OLD.tag_id;
END IF;
END