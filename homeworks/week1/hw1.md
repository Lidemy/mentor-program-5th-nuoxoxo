# 交作業流程

## 開始 Workflow
`git branch w1` 新建支線
`git checkout w1` 轉入支線，以支線身份去完成作業

## 完成作業後
`git commit -am "Update homework 1"` commit 總是到本地
`git push origin w1` push 總是推到遠端

同時在集特盒上 `Create Pull Request`
這一步會將 branch 合併至 master

注意 `git pull` 和 *pull request* 不一樣：
`git pull`是把`遠端`的改動，合併到`本地`
而 *pull request* 則是會請求遠端，希望將`本地`的改動合併到`遠端`

## 等作業改好 
`git checkout master` 切換成主線
`git pull origin master` 從遠端 origin 將 master 這個 branch 取代本地 master

`git branch -d w1` 完成支線
