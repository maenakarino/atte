# 勤怠管理システム

## 環境構築

 ### Dockerビルド
 1、[git clone](https://github.com/maenakarino/atte)
 
 2、docker-compose up -d --build

 ### Laravel環境構築
 1、docker-compose exec php bash
 
 2、composer install
 
 3、.env.exampleファイルから.envを作成し、環境変数を変更
 
 4、php artisan key:generate
 
 5、php artisan migrate
 
 6、php artisan db:seed

## 使用技術
　・php 8.0
 
 ・Laravel 10.0
 
 ・MySQL　8.0

## テーブル設計
 ![usersテーブル](https://github.com/user-attachments/assets/863e9f55-128a-486d-b2f4-00fa803a57b1)

 ![worksテーブル](https://github.com/user-attachments/assets/f883a11c-41b0-4c53-8598-f7bb15d9d49a)

 ![restsテーブル](https://github.com/user-attachments/assets/3da2d115-8da4-4068-a865-b61b20e19376)






## ER図
 ![atte ER](https://github.com/user-attachments/assets/d03f47b5-c803-4282-af6a-631d6a5389a4)


## URL
 ・開発環境：http://localhost/

 ・php MyAdmin :http://localhost:8080/

 
 
 
 
 
