/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : 65001

 Date: 28/01/2022 00:33:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS test;
Use test;
-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '投稿の表題',
  `body` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '投稿の本文',
  `author` int(10) NULL DEFAULT NULL COMMENT '筆者',
  `modified` timestamp NULL DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES (1, 'PHPとは？初心者向けプログラミング言語のPHPでできることも徹底解説', 'PHPの構文は比較的簡単で、シンプルに記述ができます。たとえば以下のように記述することで、HTML上に文字列を出力することが可能ですが、プログラミング言語によっては型名を書く必要があるなど、制約が多く、行数が増えてしまうこともあります。\r\n\r\nその点PHPは、自動で型の調整などを行ってくれるため、シンプルに記述することが可能です。シンプルに記述できるということは、覚えることが少なく、またバグがわかりやすいということでもあります。こうした点は特に初心者のうちは、ありがたいポイントになります。\r\n\r\n', 1, '2022-01-25 23:25:34');
INSERT INTO `articles` VALUES (2, 'jQueryとは｜メリット・デメリットから記述方法まで解説', 'jQueryはJavaScriptのためのライブラリです。jQueryを使用することでシンプルにJavaScriptを記述できるようになり、それまで数十行にわたるコードが必要だった処理もわずか数行で実行できるようになりました。\r\n\r\njQueryの登場によってフロントエンド開発が効率化され、JavaScriptを用いた複雑な記述が必要なくなったことで、多くの人がフロントエンドエンジニアとして活躍できるようになりました。', 1, '2022-01-26 20:12:42');
INSERT INTO `articles` VALUES (3, 'Bootstrap5で高速に', '世界で一番人気のあるフロントエンドライブラリ Bootstrap を使って、モバイルファーストなレスポンシブウェブを素早くデザイン・カスタマイズできます。Sass変数と mixin、レスポンシブグリッドシステム、豊富なコンポーネント、強力な JavaScript プラグインを備えています。', 1, '2022-01-26 20:13:06');
INSERT INTO `articles` VALUES (4, 'JavaScript入門', 'JavaScript はクライアント側で実行されるオブジェクト指向型のスクリプト言語です。 JavaScript を用いることで、動的にWebページの内容を書き換えたりフォームに入力された内容をクライアント側でチェックしたりできます。ここでは JavaScript の使い方として JavaScript のプログラミングの方法をサンプルを用いて解説していきます。', 2, '2022-01-27 22:49:19');
INSERT INTO `articles` VALUES (5, 'JSPとは', 'JSP（Java Server Pages）はHTMLページの中にプログラムを埋め込むタイプのスクリプト言語です。よく似た言語にASPやPHPがあります。それのJavaバージョンと考えれば良いでしょう。以下はJSPのサンプルです。', 2, '2022-01-27 22:50:22');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `userid`(`userid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'm21w0b16', 'm21w0b16', '仝亜西');
INSERT INTO `users` VALUES (2, 'test01', 'pass1', 'テスト1');

SET FOREIGN_KEY_CHECKS = 1;
