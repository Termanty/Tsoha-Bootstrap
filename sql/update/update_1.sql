ALTER TABLE Tag
  DROP CONSTRAINT tag_topic_id_fkey,
  DROP CONSTRAINT tag_category_id_fkey,
  ADD 
    CONSTRAINT tag_topic_id_fkey 
    FOREIGN KEY (topic_id) 
    REFERENCES Topic(id) 
    ON DELETE CASCADE,
  ADD CONSTRAINT tag_category_id_fkey
    FOREIGN KEY (category_id) 
    REFERENCES Category(id)
    ON DELETE CASCADE;

