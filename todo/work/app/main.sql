CREATE TABLE todos (
  id INT NOT NULL AUTO_INCREMENT,
  -- todoが完了状態にあるかどうか初期値はfalse
  is_done BOOL DEFAULT false,
  title TEXT,
  PRIMARY KEY (id)
);


CREATE TABLE newtitles (
  id INT NOT NULL AUTO_INCREMENT,
  title TEXT,
  PRIMARY KEY (id)
);

SELECT * FROM todos;