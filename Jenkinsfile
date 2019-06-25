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
                          archiveArtifacts '**/*.html'
                        }
              }
              
              stage('Transferring code to destination server') {
                    steps {
                          rsync -lrazvp . 10.2.1.55:/var/www/html/
                          }
              }
       }
}
