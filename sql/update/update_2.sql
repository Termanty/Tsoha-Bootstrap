
ALTER TABLE Member
  ADD deleted BOOLEAN NOT NULL DEFAULT FALSE;

ALTER TABLE Topic
  ADD deleted BOOLEAN NOT NULL DEFAULT FALSE;

ALTER TABLE Message
  ADD deleted BOOLEAN NOT NULL DEFAULT FALSE;
