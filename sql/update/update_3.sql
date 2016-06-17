ALTER TABLE Message
  ALTER COLUMN published TYPE timestamp;

ALTER TABLE Topic
  ALTER COLUMN published TYPE timestamp;
