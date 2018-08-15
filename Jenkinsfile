#!/usr/bin/env groovy

node {
    def images = [:]
    def imageName = "7otk/commy-api"
    def scmVars = null

    stage('prerequisite') {
        scmVars = checkout(scm)
    }

    stage('build') {
        def revision = scmVars.GIT_COMMIT[0..6]

        sh 'sudo docker build -t $imageName:$revision -f docker/api-dockerfile .'
    }

    stage('deploy') {
        if (env.BRANCH_NAME == 'master') {
           sh 'sudo docker push $imageName:latest'
        }

        sh 'sudo docker push $imageName:$revision'
    }
}