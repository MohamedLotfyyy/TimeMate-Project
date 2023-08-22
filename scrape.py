from requests_html import HTMLSession
import json
cookies = {
    '_ga_SV8J0NYWL6': 'GS1.1.1675350326.217.1.1675350521.0.0.0',
    '_ga': 'GA1.3.1556673140.1666189902',
    '_ga_1TENYPZJ0W': 'GS1.1.1675350324.160.1.1675350332.0.0.0',
    '__atuvc': '1%7C42',
    '__atssc': 'google%3B1',
    '_hjSessionUser_1456469': 'eyJpZCI6ImNkYmUwZDEzLTdlNTgtNTVjMi1iMjNiLTE1ZmYwYjFkN2U4MSIsImNyZWF0ZWQiOjE2NjY2MDM0OTk0MDQsImV4aXN0aW5nIjp0cnVlfQ==',
    'OptanonConsent': 'isGpcEnabled=0&datestamp=Sat+Dec+03+2022+20%3A21%3A48+GMT%2B0000+(Greenwich+Mean+Time)&version=6.38.0&isIABGlobal=false&hosts=&consentId=7cbce1d4-4e67-4830-b755-6522675c77f9&interactionCount=1&landingPath=NotLandingPage&groups=C0001%3A1%2CC0002%3A1%2CC0003%3A1%2CC0004%3A1&geolocation=GB%3BENG&AwaitingReconsent=false',
    'OptanonAlertBoxClosed': '2022-11-25T17:34:41.478Z',
    '_ga_JY0XQGM1Y3': 'GS1.1.1669404116.2.0.1669404116.0.0.0',
    '_ga_Z9M4Y77VXZ': 'GS1.1.1670097594.3.1.1670099814.0.0.0',
    '_ga_WL8VVSMZQ2': 'GS1.1.1670097594.3.1.1670099814.0.0.0',
    '_tt_enable_cookie': '1',
    '_ttp': '2296d762-01de-4200-baf1-531f4575a87a',
    '_hjSessionUser_1511907': 'eyJpZCI6Ijk2MGYyMTA5LWVmNTAtNWY1Zi1hN2Y4LTQzZjkwMmNiYzY0ZSIsImNyZWF0ZWQiOjE2Njk3MjYwNTc3MDUsImV4aXN0aW5nIjp0cnVlfQ==',
    '_uetvid': 'ffa5d3206fe311eda755cd97d0fb420f',
    '__utma': '70057868.1556673140.1666189902.1672316278.1674645685.2',
    '__utmz': '70057868.1674645685.2.2.utmcsr=login.manchester.ac.uk|utmccn=(referral)|utmcmd=referral|utmcct=/',
    'PHPSESSID': 'ST-16101230-oJumkAIj30wOFYlQwDRr-jargalant',
}

headers = {
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/109.0',
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,/;q=0.8',
    'Accept-Language': 'en-GB,en;q=0.5',
    # 'Accept-Encoding': 'gzip, deflate, br',
    'Connection': 'keep-alive',
    # 'Cookie': '_ga_SV8J0NYWL6=GS1.1.1675350326.217.1.1675350521.0.0.0; _ga=GA1.3.1556673140.1666189902; _ga_1TENYPZJ0W=GS1.1.1675350324.160.1.1675350332.0.0.0; __atuvc=1%7C42; __atssc=google%3B1; _hjSessionUser_1456469=eyJpZCI6ImNkYmUwZDEzLTdlNTgtNTVjMi1iMjNiLTE1ZmYwYjFkN2U4MSIsImNyZWF0ZWQiOjE2NjY2MDM0OTk0MDQsImV4aXN0aW5nIjp0cnVlfQ==; OptanonConsent=isGpcEnabled=0&datestamp=Sat+Dec+03+2022+20%3A21%3A48+GMT%2B0000+(Greenwich+Mean+Time)&version=6.38.0&isIABGlobal=false&hosts=&consentId=7cbce1d4-4e67-4830-b755-6522675c77f9&interactionCount=1&landingPath=NotLandingPage&groups=C0001%3A1%2CC0002%3A1%2CC0003%3A1%2CC0004%3A1&geolocation=GB%3BENG&AwaitingReconsent=false; OptanonAlertBoxClosed=2022-11-25T17:34:41.478Z; _ga_JY0XQGM1Y3=GS1.1.1669404116.2.0.1669404116.0.0.0; _ga_Z9M4Y77VXZ=GS1.1.1670097594.3.1.1670099814.0.0.0; _ga_WL8VVSMZQ2=GS1.1.1670097594.3.1.1670099814.0.0.0; _tt_enable_cookie=1; _ttp=2296d762-01de-4200-baf1-531f4575a87a; _hjSessionUser_1511907=eyJpZCI6Ijk2MGYyMTA5LWVmNTAtNWY1Zi1hN2Y4LTQzZjkwMmNiYzY0ZSIsImNyZWF0ZWQiOjE2Njk3MjYwNTc3MDUsImV4aXN0aW5nIjp0cnVlfQ==; _uetvid=ffa5d3206fe311eda755cd97d0fb420f; __utma=70057868.1556673140.1666189902.1672316278.1674645685.2; __utmz=70057868.1674645685.2.2.utmcsr=login.manchester.ac.uk|utmccn=(referral)|utmcmd=referral|utmcct=/; PHPSESSID=ST-16101230-oJumkAIj30wOFYlQwDRr-jargalant',
    'Upgrade-Insecure-Requests': '1',
    'Sec-Fetch-Dest': 'document',
    'Sec-Fetch-Mode': 'navigate',
    'Sec-Fetch-Site': 'none',
    'Sec-Fetch-User': '?1',
}

session = HTMLSession()
url = 'https://studentnet.cs.manchester.ac.uk/me/spotv2/spotv2.php'
request = session.get(url, cookies=cookies, headers=headers)
table = request.html.find('#dueAssessments')

tabledata = [[c.text for c in row. find( 'td')] for row in table[0].find('tr')]
tableheader = [[c.text for c in row. find('th')] for row in table[0].find('tr' )][0]

data_dict = [dict (zip(tableheader, t)) for t in tabledata]

with open('table.json', 'w') as data:
    json.dump(data_dict, data)
