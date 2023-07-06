CREATE TABLE academic_year(
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(10) NOT NULL,
  semester VARCHAR(6) NOT NULL,
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  status VARCHAR(10) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
CREATE TABLE teacher (
  id BIGINT(20) AUTO_INCREMENT,
  user_id BIGINT(20),
  status VARCHAR(10) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE class (
  id BIGINT UNSIGNED AUTO_INCREMENT,
  academic_year_id BIGINT(20),
  teacher_id BIGINT(20) UNSIGNED,
  name varchar(10) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (academic_year_id) REFERENCES academic_year(id),
  FOREIGN KEY (teacher_id) REFERENCES teacher(id)
);
CREATE TABLE student (
  id BIGINT(20) UNSIGNED AUTO_INCREMENT,
  user_id BIGINT(20),
  status VARCHAR(10) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE exercise (
  id BIGINT(20) UNSIGNED AUTO_INCREMENT,
  academic_year_id BIGINT,
  name varchar(255),
  desccription varchar(255),
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (academic_year_id) REFERENCES academic_year(id)
);

CREATE TABLE exercise_question (
  id BIGINT(20) UNSIGNED AUTO_INCREMENT,
  exercise_id BIGINT(20) UNSIGNED,
  question_id BIGINT(20) UNSIGNED,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (exercise_id) REFERENCES exercise(id),
  FOREIGN KEY (question_id) REFERENCES question(id)
);

CREATE TABLE submissions (
  id BIGINT(20) UNSIGNED AUTO_INCREMENT,
  student_id BIGINT(20) UNSIGNED,
  question_id BIGINT(20) UNSIGNED,
  status VARCHAR(10),
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (student_id) REFERENCES users(id),
  FOREIGN KEY (question_id) REFERENCES question(id)
);