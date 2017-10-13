### Via Config:

```
repo:
    REST:
        url: git@127.0.0.1:Web/project-1.git
        main: develop
        watch:
            - production/aaa
            - production/bbbb
            - master
        rule: "fix(\\w*):"
        exclude:
            - "ba8b596 - fix(register): Fixed xxxxx"
```

### Via Shell:

```shell
php index.php
```

### Response:

```                                                                                                    ‹›
Switched to branch 'production/a'
Switched to branch 'production/b'
Switched to branch 'master'
-----------------------------
Project: project-1
Branch: master
commit-1: b7d7548 - fix(register): Fixed xxxxxx
commit-2: ac222c1 - fix(mail): Fixed xxxxxx
commit-3: 3c5d028 - fix(mail): Fixed xxxxxx
commit-4: 0e91d93 - fix(register): Fixed xxxxxx
commit-5: 20ac523 - fix(user): Fixed xxxxxx
commit-6: e919576 - fix(register): Fixed xxxxxx
```
