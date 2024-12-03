package models

import (
	"log"
	"xorm.io/xorm"
	_"github.com/go-sql-driver/mysql"
)

var Engine *xorm.Engine

func InitXorm() (err error) {
	Engine, err = xorm.NewEngine("mysql", "rashnu:rashnuroot@tcp(127.0.0.1:3306)/ticket_sales?charset=utf8")
	if err != nil {
		log.Println("NewEngine error:", err)
		return err
	}

	if err = Engine.Ping(); err != nil {
		log.Println("Ping error:", err)
		return err
	}

	return nil
}