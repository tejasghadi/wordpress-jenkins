pipeline {
    agent any
       stages {
            stage('SCM checkout') {
                  steps {
                        git url: 'https://github.com/tejasghadi/wordpress-jenkins.git'
                        }
             }
             
             stage('archiving artifacts') {
                  steps {
                          archiveArtifacts '**/*'
                        }
              }
              
              stage('Transferring code to destination server') {
                    steps {
                          sh 'rsync -lrazvp --delete --exclude=.git ./ root@10.2.1.55:/var/www/html/'
                          }
              }
       }
}
