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
        images.api = docker.build("${imageName}:${revision}", "-f docker/api-dockerfile .")
    }

    stage('deploy') {
        if (env.BRANCH_NAME == 'master') {
            images.api.push('latest')
        }

        images.api.push(env.BRANCH_NAME)
    }
}