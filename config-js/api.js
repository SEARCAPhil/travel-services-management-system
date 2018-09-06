const settings = {
  protocol: 'http',
  host: 'localhost',
  port: null,
  domain:'trs/public',
}
settings.url = `${settings.protocol}://${settings.host}${settings.port ? ':this.port'  : ''}/${settings.domain}`

export default settings