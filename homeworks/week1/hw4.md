一直以來 git 對我來說就是 Github。桌面版 GitHub 能快捷地推拉和提交，只要不做太複雜的事，就算不了解 branch 或 head 也沒什麼問題。直到在命令列上做版本控制/交作業和回收，才得以理解到一點點 git 的工作原理。

我把 git 當成一位同事。案子做好後就交給ta。每拿到新的案子，第一步是 init 這個同事。

##

新的追蹤
```
echo "hello，world" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin git@github.com:user/repo.git
git push -u origin main

commit -m 旗子意思是加一行對改動的解釋
branch -M 大寫 M 表示強移動
push -u 目的地在上游，命令將改動推向上游
```
第一次會要求用戶名和密碼

##

如果 Update
```
git commit -am "Update README.md"
git push origin main

-am 全部提交 並附一條簡訊
```

支線可以改名\
`git branch -m name`

因為不熟練，錯將 init 過的 file/folder 改名的情況，要重新add\
`git add dir`

##

歷史\
`git log --oneline`

腳印\
`git log --oneline --graph --all`

查一段記憶
```
git checkout 69a86a8
git checkout main
```

回退 commit > 將 HEAD 回退一級\
`git reset HEAD^ --hard`

同時 local 也會 reset\
做這一步，要清楚自己的目的，否則將產生代價\

原則上，為了和 git 好好合作，最好等到確定能夠提交時才提交，\
正如SCM上所說：`如果 git 無法很乾淨地回到過去，就不會讓你回到過去`\

##

要注意一點就是，當發現本來已經做好的作業，現在是空的！不用擔心，大概率是因為支線不對。用`git checkout homework1`回到`作業支線`就可以了。
